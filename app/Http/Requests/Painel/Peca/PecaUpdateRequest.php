<?php

namespace App\Http\Requests\Painel\Peca;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PecaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $pecaId = $this->peca->id;
        $fornecedorId = $this->peca->fornecedor_id;

        // Regra das aplicações
        $rules = [
            'aplicacoes'                => 'nullable|array',
            'aplicacoes.*.tipo_veiculo' => 'required|in:carro,caminhao,moto',
            'aplicacoes.*.modelo_id'    => 'nullable|exists:modelos,id',
        ];

        $aplicacoes = $this->aplicacoes ?? [];
        foreach ($aplicacoes as $i => $aplicacao) {
            $rules["aplicacoes.{$i}.ano_de"]  = "nullable|numeric|lte:aplicacoes.{$i}.ano_ate|min:1000|max:3000";
            $rules["aplicacoes.{$i}.ano_ate"] = "nullable|numeric|gte:aplicacoes.{$i}.ano_de|min:1000|max:3000";
        }

        return [
            'marca_id'      => 'nullable|exists:marcas,id',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'sku'           => "required|string|max:255|unique:pecas,sku,{$pecaId},id,fornecedor_id,{$fornecedorId}",
            'nome'          => 'required|string|max:255',
            'estoque'       => 'required|numeric|min:1',
            'preco'         => 'required|numeric|min:0.01',
            'tipo_peca'     => 'required|in:alternativa,genuina,original,after,reuso',
            'absoleta'      => 'required|boolean',
            ...$rules
        ];
    }

    public function attributes()
    {
        $attributes = [
            'aplicacoes.*.tipo_veiculo' => 'tipo de veículo',
            'aplicacoes.*.modelo_id'    => 'veículo',
        ];

        $aplicacoes = $this->aplicacoes ?? [];
        foreach ($aplicacoes as $i => $aplicacao) {
            $attributes["aplicacoes.{$i}.ano_de"] = 'ano de';
            $attributes["aplicacoes.{$i}.ano_ate"] = 'ano até';
        }

        return $attributes;
    }
}
