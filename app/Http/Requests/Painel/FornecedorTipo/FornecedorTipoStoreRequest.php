<?php

namespace App\Http\Requests\Painel\FornecedorTipo;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorTipoStoreRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
        ];
    }
}
