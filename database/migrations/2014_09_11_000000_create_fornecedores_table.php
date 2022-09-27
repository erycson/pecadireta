<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Fornecedor;
use App\Models\Agrupamento;
use App\Models\FornecedorTipo;
use Illuminate\Support\Facades\DB;
use App\Models\Cep;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrupamentos', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nome');
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        Schema::create('fornecedor_tipos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Agrupamento::class)->nullable()->references('id')->on('agrupamentos')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(FornecedorTipo::class)->nullable()->references('id')->on('fornecedor_tipos')->nullOnDelete()->cascadeOnUpdate();
            $table->char('cnpj', 14)->unique();
            $table->string('url')->nullable();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->foreignIdFor(Cep::class)->nullable()->references('id')->on('ceps')->nullOnDelete()->cascadeOnUpdate();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->geometry('geolocalizacao')->nullable();
            $table->date('avaliacao_ate')->nullable();
            $table->date('pago_ate')->nullable();
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        $agrupamento = Agrupamento::create(['slug' => 'brasilwagen', 'nome' => 'Brasilwagen']);

        $fornecedorTipo = FornecedorTipo::create(['nome' => 'Concessionária']);
        FornecedorTipo::create(['nome' => 'Distribuidor']);
        FornecedorTipo::create(['nome' => 'Auto Peça']);
        FornecedorTipo::create(['nome' => 'Reuso']);

        Fornecedor::create([
            'agrupamento_id' => $agrupamento->id,
            'fornecedor_tipo_id' => $fornecedorTipo->id,
            'cnpj' => '49707557001128',
            'url' => 'https://www.brasilwagen.com.br/',
            'razao_social' => 'Brasilwagen Comercio de Veiculos S/A',
            'nome_fantasia' => 'Brasilwagen',
            'cep_id' => 879168,
            'numero' => '16',
            'complemento' => null,
            'geolocalizacao' => ['latitude' => -23.5160315, 'longitude' => -46.6082439],
            'avaliacao_ate' => now()->addMonths(3)->endOfMonth(),
            'pago_ate' => now()->addMonths(4)->endOfMonth()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
        Schema::dropIfExists('fornecedor_tipos');
        Schema::dropIfExists('agrupamentos');
    }
};
