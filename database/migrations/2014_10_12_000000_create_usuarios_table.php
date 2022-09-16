<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestampTz('verificado_em', 0)->nullable();
            $table->string('senha');
            $table->string('token_relembrar', 100)->nullable();

            $table->timestampTz('criado_em', 0)->nullable();
            $table->timestampTz('atualizado_em', 0)->nullable();
            $table->timestampTz('removido_em', 0)->nullable();
        });

        Usuario::create([
            'email' => 'egdn2004@gmail.com',
            'nome' => 'Érycson Nóbrega',
            'senha' => Hash::make('12345678'),
            'verificado_em' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
