<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FornecedorTipo extends Model implements HasAsyncSelect
{
    use AsyncSelectTrait, SoftDeletes;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    protected $fillable = [
        'nome',
    ];

    public function fornecedores()
    {
        return $this->hasMany(Fornecedor::class);
    }
}
