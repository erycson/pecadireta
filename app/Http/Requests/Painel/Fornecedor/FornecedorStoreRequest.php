<?php

namespace App\Http\Requests\Painel\Fornecedor;

use Illuminate\Foundation\Http\FormRequest;
use App\Libraries\Contato\ContatoRequestTrait;

class FornecedorStoreRequest extends FormRequest
{
    use ContatoRequestTrait;

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
        return array_merge([
            'cnpj'                     => 'required|string|cnpj|unique:fornecedores,cnpj',
            'url'                      => 'required|string|url|max:255',
            'agrupamento_id'           => 'nullable|exists:agrupamentos,id',
            'fornecedor_tipo_id'       => 'nullable|exists:fornecedor_tipos,id',
            'razao_social'             => 'required|string|max:255',
            'nome_fantasia'            => 'required|string|max:255',
            'cep_id'                   => 'required|exists:ceps,id',
            'numero'                   => 'nullable|string|max:255',
            'complemento'              => 'nullable|string|max:255',
            'geolocalizacao'           => 'nullable|array',
            'geolocalizacao.latitude'  => 'required|numeric',
            'geolocalizacao.longitude' => 'required|numeric',
            'avaliacao_ate'            => 'nullable|date',
            'pago_ate'                 => 'nullable|date',
        ], $this->contatoRules());
    }

    public function attributes()
    {
        return $this->contatoAttributes();
    }
}
