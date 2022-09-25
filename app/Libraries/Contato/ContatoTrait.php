<?php

namespace App\Libraries\Contato;

use App\Models\Contato;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ContatoTrait
{
    public function contatos(): MorphMany
    {
        return $this->morphMany(Contato::class, 'contactavel');
    }
}

