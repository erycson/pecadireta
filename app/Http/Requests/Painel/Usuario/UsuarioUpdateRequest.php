<?php

namespace App\Http\Requests\Painel\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
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
        $usuarioId = $this->user()->id;
        return [
            'nome'  => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:usuarios,email,{$usuarioId}",
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'senha' => 'nullable|string|min:8',
        ];
    }
}
