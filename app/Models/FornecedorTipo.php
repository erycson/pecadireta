<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use Illuminate\Database\Eloquent\Model;

class FornecedorTipo extends Model implements HasAsyncSelect
{
    use AsyncSelectTrait;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    protected $fillable = [
        'nome',
    ];
}
