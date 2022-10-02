<?php

namespace App\Models;

use App\Libraries\Contato\TipoContato;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Contato extends Model implements Sortable
{
    use SortableTrait;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'tipo',
        'contato',
        'descricao',
        'ordem',
    ];

    protected $casts = [
        'tipo' => TipoContato::class,
    ];

    /**
     * Get the owner model of the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contactavel(): MorphTo
    {
        return $this->morphTo('contactavel', 'contactavel_type', 'contactavel_id', 'id');
    }

    protected function iconeCss(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->tipo) {
                TipoContato::Email => 'bx-envelope',
                TipoContato::Celular => 'bx-phone',
                TipoContato::Telefone => 'bx-phone',
                TipoContato::WhatsApp => 'bxl-whatsapp',
            }
        );
    }

    protected function iconeCor(): Attribute
    {
        return Attribute::make(
            get: fn() => match ($this->tipo) {
                TipoContato::Email => 'btn-outline-dark',
                TipoContato::Celular => 'btn-outline-info',
                TipoContato::Telefone => 'btn-outline-secondary',
                TipoContato::WhatsApp => 'btn-outline-success',
            }
        );
    }
}
