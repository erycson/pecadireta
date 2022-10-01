<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use App\Libraries\Contato\ContatoTrait;
use App\Libraries\Contato\HasContato;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Fornecedor extends Model implements HasMedia, HasAsyncSelect, HasContato
{
    use InteractsWithMedia,
        SoftDeletes,
        AsyncSelectTrait,
        ContatoTrait;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';
    const DELETED_AT = 'removido_em';
    protected $table = 'fornecedores';

    protected $fillable = [
        'agrupamento_id',
        'fornecedor_tipo_id',
        'cnpj',
        'url',
        'razao_social',
        'nome_fantasia' ,
        'cep_id',
        'numero',
        'complemento',
        'geolocalizacao',
        'pago_ate',
        'avaliacao_ate',
    ];

    protected $casts = [
        'pago_ate'      => 'datetime',
        'avaliacao_ate' => 'datetime',
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->setAsyncSelectOptions([
            'value' => 'id',
            'label' => 'nome_fantasia',
        ]);
    }

    protected static function booted()
    {
        static::addGlobalScope('geolocalizacao', function (Builder $builder) {
            if (empty($builder->getQuery()->columns)) {
                $builder->select('*');
            }
            $builder->selectRaw("geolocalizacao.ToString() AS geolocalizacao");
        });
    }

    public function agrupamento()
    {
        return $this->belongsTo(Agrupamento::class);
    }

    public function tipo()
    {
        return $this->belongsTo(FornecedorTipo::class, 'fornecedor_tipo_id');
    }

    public function cep()
    {
        return $this->belongsTo(Cep::class);
    }

    public function pecas()
    {
        return $this->hasMany(Peca::class);
    }

    protected function geolocalizacao(): Attribute
    {
        return Attribute::make(
            set: fn($value) => DB::raw(sprintf('geography::Point(%f, %f, 4326)', $value['latitude'], $value['longitude'])),
        );
    }
}
