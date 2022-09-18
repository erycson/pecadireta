<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    protected $fillable = [
        'tipo',
        'pergunta',
        'resposta',
    ];

    protected $casts = [
        'tipo' => 'int',
    ];

    protected function tipoExtenso(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->tipo) {
                1 => 'Compradores',
                2 => 'Anunciantes',
                default => dd($this->tipo)
            },
        );
    }
}
