<?php

use App\Libraries\Peca\TipoPeca;
use App\Libraries\Peca\TipoVeiculo;
use App\Models\Fornecedor;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Montadora;
use App\Models\Peca;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MeiliSearch\Client;

return new class extends Migration
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(env('MEILISEARCH_HOST'), env('MEILISEARCH_KEY'));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('marcas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        Schema::create('pecas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fornecedor::class)->references('id')->on('fornecedores');
            $table->foreignIdFor(Marca::class)->nullable()->references('id')->on('marcas');
            $table->string('tipo_peca')->nullable();
            $table->string('sku');
            $table->string('nome');
            $table->string('categoria')->nullable();
            $table->string('subcateogria')->nullable();
            $table->string('tamanho')->nullable();
            $table->string('peso')->nullable();
            $table->boolean('absoleta')->default(false);
            $table->unsignedInteger('estoque');
            $table->unsignedDecimal('preco', 10, 2);
            $table->char('versao', 8);
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);

            $table->unique(['sku', 'fornecedor_id']);
        });

        Schema::create('aplicacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Peca::class)->references('id')->on('pecas');
            $table->foreignIdFor(Modelo::class)->nullable()->references('id')->on('modelos');
            $table->unsignedSmallInteger('ano_de')->nullable();
            $table->unsignedSmallInteger('ano_ate')->nullable();
            $table->string('tipo_veiculo')->nullable();
        });

        $csv   = trim(file_get_contents(storage_path('pecas.csv')));
        $pecas = collect(array_map(fn ($linha) => str_getcsv($linha, ';'), explode("\n", $csv)));

        $montadoras = Montadora::get()->keyBy('nome');
        $modelos    = Modelo::get()->keyBy('nome');

        // Cadastra as marcas
        $marcas = $pecas
            ->filter(fn ($peca) => !empty(trim($peca[1])))
            ->groupBy(fn ($peca) => strtoupper(trim($peca[1])))
            ->sortKeys()
            ->keys()
            ->map(fn($marca) => Marca::create(['nome' => $marca]))
            ->keyBy('nome');

        $pecas
            ->filter(fn ($peca) => intval($peca[8]) > 0)
            ->map(fn ($peca) => collect([
                'fornecedor_id' => 1,
                'sku' => trim($peca[0]),
                'marca_id' => optional($marcas->get(strtoupper(trim($peca[1]))))->id,
                'nome' => trim($peca[2]),
                'montadora_id' => optional($montadoras->get(strtoupper(trim($peca[3]))))->id,
                'modelo_id' => optional($modelos->get(strtoupper(trim($peca[4]))))->id,
                'ano_de' => intval(trim($peca[5])),
                'ano_ate' => intval(trim($peca[6])),
                'preco' => floatval(trim($peca[7])),
                'estoque' => intval(trim($peca[8])),
                'categoria' => strtoupper(trim($peca[9])),
                'subcategoria' => strtoupper(trim($peca[10])),
                'tamanho' => strtoupper(trim($peca[11])),
                'peso' => strtoupper(trim($peca[12])),
                'tipo_peca' => TipoPeca::Genuina->value,
                'tipo_veiculo' => TipoVeiculo::Carro->value,
                'absoleta' => false,
            ]))
            ->groupBy('sku')
            ->each(function ($pecas) {
                $peca = Peca::create($pecas->first()->only([
                    'marca_id',
                    'fornecedor_id',
                    'sku',
                    'nome',
                    'estoque',
                    'categoria',
                    'subcateogria',
                    'tamanho',
                    'peso',
                    'preco',
                    'tipo_peca',
                    'absoleta',
                ])->toArray());

                $pecas->each(fn ($aplicacao) => $peca->aplicacoes()->create($aplicacao->only([
                    'modelo_id',
                    'ano_de',
                    'ano_ate',
                    'tipo_veiculo'
                ])->toArray()));
            });

        $this->client->index('idx_pecas')->updateSortableAttributes([
            'fornecedor_nome',
            'nome',
            'estoque',
            'preco',
            'atualizado_em',
        ]);
        $this->client->index('idx_pecas')->updateFilterableAttributes([
            'tipos_veiculos',
            'montadoras',
            'modelos',
            'atualizado_dias',
            'absoleta',

            'uf',
            'municipio',
            'cep',

            'fornecedor_id',
            'fornecedor_tipo',
            'tipo_peca',
        ]);
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplicacoes');
        Schema::dropIfExists('pecas');
        Schema::dropIfExists('marcas');
    }
};
