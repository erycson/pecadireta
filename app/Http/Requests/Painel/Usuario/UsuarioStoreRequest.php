<?php

namespace App\Http\Requests\Painel\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioStoreRequest extends FormRequest
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
            'nome'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:usuarios,email',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'senha'         => 'required|string|min:8',
        ];
    }
}
