<?php

use App\Models\Modelo;
use App\Models\Montadora;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('montadoras', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Montadora::class)->nullable()->references('id')->on('montadoras')->cascadeOnUpdate()->onDelete('cascade');
            $table->string('nome');
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        $csv   = trim(file_get_contents(storage_path('pecas.csv')));
        $pecas = collect(array_map(fn ($linha) => str_getcsv($linha, ';'), explode("\n", $csv)));
        $pecas
            ->filter(fn ($peca) => !empty(trim($peca[3])))
            ->groupBy(fn ($peca) => strtoupper(trim($peca[3])))
            ->sortKeys()
            ->each(function ($pecas, $marca) {
                // Cadastra as Montadoras
                $montadora = Montadora::create(['nome' => $marca]);

                // Cadastra os Modelos
                $pecas
                    ->filter(fn ($peca) => !empty(trim($peca[4])))
                    ->groupBy(fn ($peca) => strtoupper(trim($peca[4])))
                    ->sortKeys()
                    ->keys()
                    ->each(fn($modelo) => $montadora->modelos()->create(['nome' => $modelo]));
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelos');
        Schema::dropIfExists('montadoras');
    }
};
