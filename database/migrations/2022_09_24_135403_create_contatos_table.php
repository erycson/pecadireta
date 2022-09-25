<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->morphs('contactavel');
            $table->string('tipo', 15);
            $table->string('contato');
            $table->string('descricao')->nullable();
            $table->unsignedInteger('ordem')->nullable();
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatos');
    }
};
