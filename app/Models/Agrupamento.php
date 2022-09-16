<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use App\Libraries\AsyncSelect\AsyncSelectTrait;

class Agrupamento extends Model implements HasMedia, HasAsyncSelect
{
    use InteractsWithMedia, SoftDeletes, AsyncSelectTrait;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    protected $fillable = [
        'slug',
        'nome',
    ];
}
