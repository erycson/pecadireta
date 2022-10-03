<?php

use App\Libraries\Peca\TipoPeca;
use App\Libraries\Peca\TipoVeiculo;
use App\Models\Fornecedor;
use App\Models\Marca;
use App\Models\Modelo;
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
            $table->foreignIdFor(Fornecedor::class)->nullable()->references('id')->on('fornecedores')->cascadeOnUpdate()->onDelete('cascade');
            $table->foreignIdFor(Marca::class)->references('id')->on('marcas')->cascadeOnUpdate()->onDelete('cascade');
            $table->string('tipo_peca')->nullable();
            $table->string('sku');
            $table->string('nome');
            $table->boolean('absoleta')->default(false);
            $table->unsignedInteger('estoque');
            $table->unsignedDecimal('preco', 10, 2);
            $table->char('versao', 8);
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
        });

        Schema::create('aplicacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Peca::class)->references('id')->on('pecas')->cascadeOnUpdate()->onDelete('cascade');
            $table->foreignIdFor(Modelo::class)->nullable()->references('id')->on('modelos')->cascadeOnUpdate()->onDelete('cascade');
            $table->unsignedSmallInteger('ano_de')->nullable();
            $table->unsignedSmallInteger('ano_ate')->nullable();
            $table->string('tipo_veiculo')->nullable();
        });

        $m1 = Marca::create(['nome' => 'Fremax']);
        $m2 = Marca::create(['nome' => 'Frasle']);
        $m3 = Marca::create(['nome' => 'NGK']);
        $m4 = Marca::create(['nome' => 'Wega']);

        $peca = Peca::create(['marca_id' => $m1->id, 'fornecedor_id' => 1, 'sku' => 'BD6486', 'nome' => 'DISCO DE FREIO TRASEIRO', 'estoque' => 12, 'preco' => 356.05, 'tipo_peca' => TipoPeca::Original]);
        $peca->aplicacoes()->create(['modelo_id' => 6300, 'ano_de' => 2013, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5308, 'ano_de' => 2014, 'ano_ate' => 2017, 'tipo_veiculo' => TipoVeiculo::Carro ]);

        $peca = Peca::create(['marca_id' => $m2->id, 'fornecedor_id' => 1, 'sku' => 'PD2197', 'nome' => 'PASTILHA DE FREIO DIANTEIRA', 'estoque' => 7, 'preco' => 296.71, 'tipo_peca' => TipoPeca::Original]);
        $peca->aplicacoes()->create(['modelo_id' => 6300, 'ano_de' => 2013, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5308, 'ano_de' => 2014, 'ano_ate' => 2017, 'tipo_veiculo' => TipoVeiculo::Carro ]);

        $peca = Peca::create(['marca_id' => $m3->id, 'fornecedor_id' => 1, 'sku' => 'PLKR7B8E', 'nome' => 'VELA', 'estoque' => 30, 'preco' => 302.55, 'tipo_peca' => TipoPeca::Original]);
        $peca->aplicacoes()->create(['modelo_id' => 5399, 'ano_de' => 2010, 'ano_ate' => 2014, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5307, 'ano_de' => 2008, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5500, 'ano_de' => 2011, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);

        $peca = Peca::create(['marca_id' => $m4->id, 'fornecedor_id' => 1, 'sku' => 'AKX35161/C', 'nome' => 'FILTRO DE AR CONDICIONADO', 'estoque' => 17, 'preco' => 86.83, 'tipo_peca' => TipoPeca::Original]);
        $peca->aplicacoes()->create(['modelo_id' => 5399, 'ano_de' => 2014, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5307, 'ano_de' => 2013, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5500, 'ano_de' => 2014, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);

        $peca = Peca::create(['marca_id' => $m4->id, 'fornecedor_id' => 1, 'sku' => 'WR328', 'nome' => 'FILTRO DE AR', 'estoque' => 26, 'preco' => 97.35, 'tipo_peca' => TipoPeca::Original]);
        $peca->aplicacoes()->create(['modelo_id' => 5399, 'ano_de' => 2013, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);
        $peca->aplicacoes()->create(['modelo_id' => 5500, 'ano_de' => 2014, 'ano_ate' => null, 'tipo_veiculo' => TipoVeiculo::Carro ]);

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
            'atualizado_em',

            'uf',
            'municipio',
            'cep',

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
