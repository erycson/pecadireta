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

    #[SearchUsingFullText(['marca_nome', 'fornecedor_nome', 'peca_sku', 'peca_nome'])]
    public function toSearchableArray()
    {
        $this->loadMissing(['marca', 'fornecedor', 'aplicacoes']);

        return [
            'marca_id'        => $this->marca->id,
            'marca_nome'      => $this->marca->nome,
            'fornecedor_id'   => $this->fornecedor->id,
            'fornecedor_nome' => $this->fornecedor->nome_fantasia,
            'peca_id'         => $this->id,
            'peca_sku'        => $this->sku,
            'peca_nome'       => $this->nome,
            'peca_estoque'    => $this->estoque,
            'peca_preco'      => $this->preco,
            'aplicacoes'      => $this->aplicacoes->map(fn ($aplicacao) => [
                'modelo_id'    => $aplicacao->modelo_id,
                'ano_de'       => $aplicacao->ano_de,
                'ano_ate'      => $aplicacao->ano_ate,
                'tipo_veiculo' => $aplicacao->tipo_veiculo,
                'tipo_peca'    => $aplicacao->tipo_peca,
            ]),
        ];
    }
}
