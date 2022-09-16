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

        $agora = now();
        DB::unprepared('SET IDENTITY_INSERT montadoras ON');

        collect(json_decode(file_get_contents(storage_path('fipe-montadoras.json')), true))
            ->map(fn ($montadora) => [...$montadora, 'criado_em' => $agora, 'atualizado_em' => $agora])
            ->split(50)
            ->each(fn ($grupo) => Montadora::insert($grupo->toArray()));

        DB::unprepared('SET IDENTITY_INSERT montadoras OFF');

        DB::unprepared('SET IDENTITY_INSERT modelos ON');

        collect(json_decode(file_get_contents(storage_path('fipe-modelos.json')), true))
            ->map(fn ($modelo) => [...$modelo, 'criado_em' => $agora, 'atualizado_em' => $agora])
            ->split(50)
            ->each(fn ($grupo) => Modelo::insert($grupo->toArray()));

        DB::unprepared('SET IDENTITY_INSERT modelos OFF');
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
