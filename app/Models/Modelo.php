<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model implements HasAsyncSelect
{
    use SoftDeletes, AsyncSelectTrait;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'montadora_id',
        'nome',
    ];

    public function montadora()
    {
        return $this->belongsTo(Montadora::class);
    }
}
