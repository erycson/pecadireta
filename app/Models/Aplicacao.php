<?php

namespace App\Models;

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
        'tipo_peca',
    ];

    protected $casts = [
        'peca_id' => 'int',
        'modelo_id' => 'int',
        'ano_de' => 'int',
        'ano_ate' => 'int',
        'tipo_veiculo' => 'string',
        'tipo_peca' => 'string',
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
