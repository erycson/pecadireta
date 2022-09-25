<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use App\Libraries\Contato\ContatoTrait;
use App\Libraries\Contato\HasContato;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable implements HasAsyncSelect, HasContato
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        SoftDeletes,
        AsyncSelectTrait,
        ContatoTrait;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';

    protected $table = 'usuarios';
    protected $rememberTokenName = 'token_relembrar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'fornecedor_id',
        'email',
        'senha',
        'verificado_em',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha',
        'verificado_em',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'criado_em'     => 'datetime',
        'atualizado_em' => 'datetime',
        'verificado_em' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->attributes['senha'];
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
