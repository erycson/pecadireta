<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Montadora extends Model implements HasAsyncSelect
{
    use SoftDeletes, AsyncSelectTrait;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    protected $fillable = [
        'id',
        'nome',
    ];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
