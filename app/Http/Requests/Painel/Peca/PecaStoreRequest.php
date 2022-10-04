<?php

namespace App\Http\Requests\Painel\Peca;

use Illuminate\Foundation\Http\FormRequest;

class PecaStoreRequest extends FormRequest
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
        return [
            'marca_id' => 'required|exists:marcas,id',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'sku' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'estoque' => 'required|number|min:1',
            'preco' => 'required|number|min:0.01',
            'tipo_peca' => 'required|in:alternativa,genuina,original,after,reuso',
            'absoleta' => 'required|boolean',
        ];
    }
}
