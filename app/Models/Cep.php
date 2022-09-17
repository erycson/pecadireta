<?php

namespace App\Models;

use App\Libraries\AsyncSelect\AsyncSelectTrait;
use App\Libraries\AsyncSelect\HasAsyncSelect;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Cep extends Model implements HasAsyncSelect
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'cep',
        'uf',
        'municipio',
        'bairro',
        'tipo',
        'logradouro',
    ];

    protected function cep(): Attribute
    {
        return Attribute::make(
            get: fn($value) => str_pad($value, 8, '0', STR_PAD_LEFT),
            set: fn($value) => str_pad($value, 8, '0', STR_PAD_LEFT)
        );
    }

    protected function cepFormatado(): Attribute
    {
        return Attribute::make(
            get: fn($value) => preg_replace('/(\d{2})(\d{3})(\d{3})/', '$1.$2-$3', $this->cep),
        );
    }

    protected function cepExtenso(): Attribute
    {
        $dados = collect([
            $this->cepFormatado,
            $this->uf,
            $this->municipio,
            $this->bairro,
            trim("{$this->tipo} {$this->logradouro}"),
        ])->filter();

        return Attribute::make(
            get: fn() => $dados->join(', '),
        );
    }

    public function toAsyncSelectValue(): array
    {
        return [
            'value' => $this->id,
            'label' => $this->cepExtenso,
        ];
    }

    public static function handleAsyncSelectRequest(): \Illuminate\Http\JsonResponse
    {
        $query = (new static)->limit(20);

        $request = request();
        if ($request->filled('q')) {
            $q = preg_replace('/[^\d]+/', '', $request->q);
            $q = substr($q, 0, 8);
            $query->where('cep', 'LIKE', "{$q}%");
        }

        $dados = $query->get()->map(fn ($cep) => $cep->toAsyncSelectValue());
        return response()->json($dados);
    }
}
