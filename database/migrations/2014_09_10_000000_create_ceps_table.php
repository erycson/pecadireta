<?php

use App\Models\Cep;
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
        Schema::create('ceps', function (Blueprint $table) {
            $table->id();
            $table->char('cep', 8)->index();
            $table->char('uf', 2);
            $table->string('municipio', 50);
            $table->string('bairro', 100);
            $table->string('tipo', 50);
            $table->string('logradouro');
        });

        DB::unprepared('SET IDENTITY_INSERT ceps ON');

        $csv = array_map('str_getcsv', file(storage_path('ceps.csv')));
        $cabcalho = collect(['id', 'cep', 'uf', 'municipio', 'bairro', 'tipo', 'logradouro']);

        collect($csv)
            ->map(function ($cep) use ($cabcalho) {
                if (count($cep) != 7) dd($cep);
                return $cabcalho->combine($cep);
            })
            ->chunk(250)
            ->each(fn ($grupo) => Cep::insert($grupo->toArray()));

        DB::unprepared('SET IDENTITY_INSERT ceps OFF');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ceps');
    }
};
