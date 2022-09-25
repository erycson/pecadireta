<?php

namespace App\Libraries\Contato;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasContato
{
    public function contatos(): MorphMany;
}
