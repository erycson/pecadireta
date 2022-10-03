<?php

namespace App\Models;

use App\Libraries\Peca\TipoPeca;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Peca extends Model
{
    use Searchable;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'marca_id',
        'fornecedor_id',
        'sku',
        'nome',
        'estoque',
        'preco',
        'tipo_peca',
    ];

    protected $casts = [
        'fornecedor_id' => 'int',
        'sku' => 'string',
        'nome' => 'string',
        'estoque' => 'int',
        'preco' => 'float',
        'versao' => 'string',
        'tipo_peca' => TipoPeca::class,
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function aplicacoes()
    {
        return $this->hasMany(Aplicacao::class);
    }

    protected static function booted()
    {
        $checksum = function (Peca $peca) {
            $peca->loadMissing('aplicacoes');
            $atributos = collect($peca->attributesToArray())
                ->only([
                    'fornecedor_id',
                    'sku',
                    'nome',
                    'estoque',
                    'preco'
                ])
                ->sortKeys()
                ->values()
                ->toArray();

            $peca->versao = hash('crc32b', implode('|', $atributos));
        };

        static::creating($checksum);
        static::updating($checksum);
    }

    public function searchableAs()
    {
        return 'idx_pecas';
    }

    public function getScoutKeyName()
    {
        return 'id';
    }

    #[SearchUsingFullText(['nome', 'sku', 'marca_nome', 'fornecedor_nome', 'aplicacoes.modelo_nome', 'aplicacoes.montadora_nome'])]
    public function toSearchableArray()
    {
        $this->loadMissing(['marca', 'fornecedor', 'fornecedor.cep', 'aplicacoes', 'aplicacoes.modelo', 'aplicacoes.modelo.montadora']);

        return [
            'id'            => $this->id,
            'sku'           => $this->sku,
            'nome'          => $this->nome,
            'estoque'       => $this->estoque,
            'preco'         => $this->preco,
            'tipo_peca'     => $this->tipo_peca->value,
            'atualizado_em' => $this->fornecedor->estoque_atualizado_em,

            'marca_id'        => $this->marca->id,
            'marca_nome'      => $this->marca->nome,
            'fornecedor_id'   => $this->fornecedor->id,
            'fornecedor_nome' => $this->fornecedor->nome_fantasia,
            'fornecedor_tipo' => $this->fornecedor->fornecedor_tipo_id,
            'uf'              => $this->fornecedor->cep->uf,
            'municipio'       => $this->fornecedor->cep->municipio,
            'cep'             => $this->fornecedor->cep->cep,

            'montadoras'     => $this->aplicacoes->map(fn ($aplicacao) => $aplicacao->modelo->montadora->id)->toArray(),
            'modelos'        => $this->aplicacoes->map(fn ($aplicacao) => $aplicacao->modelo->id)->toArray(),
            'tipos_veiculos' => $this->aplicacoes->map(fn ($aplicacao) => $aplicacao->tipo_veiculo->value)->toArray(),

            'aplicacoes'      => $this->aplicacoes->map(fn ($aplicacao) => [
                'modelo_id'      => $aplicacao->modelo->id,
                'modelo_nome'    => $aplicacao->modelo->nome,
                'montadora_id'   => $aplicacao->modelo->montadora->id,
                'montadora_nome' => $aplicacao->modelo->montadora->nome,
                'ano_de'         => $aplicacao->ano_de,
                'ano_ate'        => $aplicacao->ano_ate,
                'tipo_veiculo'   => $aplicacao->tipo_veiculo->value,
            ])->toArray(),
        ];
    }
}
