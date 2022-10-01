<?php

namespace App\Models;

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

    /**
     * Get the owner model of the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contactavel(): MorphTo
    {
        return $this->morphTo('contactavel', 'contactavel_type', 'contactavel_id', 'id');
    }
}
