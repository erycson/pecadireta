<?php

namespace App\Models;

use App\Libraries\Peca\TipoVeiculo;
use Illuminate\Database\Eloquent\Model;

class Aplicacao extends Model
{
    protected $table = 'aplicacoes';
    public $timestamps = false;

    protected $fillable = [
        'peca_id',
        'montadora_id',
        'modelo_id',
        'ano_de',
        'ano_ate',
        'tipo_veiculo',
    ];

    protected $casts = [
        'peca_id' => 'int',
        'modelo_id' => 'int',
        'ano_de' => 'int',
        'ano_ate' => 'int',
        'tipo_veiculo' => TipoVeiculo::class,
    ];

    public function peca()
    {
        return $this->belongsTo(Peca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
