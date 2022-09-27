<?php

use App\Libraries\Usuario\TipoUsuario;
use App\Models\Fornecedor;
use App\Models\Usuario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Fornecedor::class)->nullable()->references('id')->on('fornecedores')->nullOnDelete()->cascadeOnUpdate();
            $table->string('tipo', 20);
            $table->string('nome');
            $table->string('email')->unique();
            $table->timestamp('verificado_em', 0)->nullable();
            $table->string('senha');
            $table->string('token_relembrar', 100)->nullable();
            $table->timestamp('criado_em', 0);
            $table->timestamp('atualizado_em', 0);
            $table->timestamp('removido_em', 0)->nullable();
        });

        Usuario::create([
            'tipo' => TipoUsuario::Adminstrador,
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
