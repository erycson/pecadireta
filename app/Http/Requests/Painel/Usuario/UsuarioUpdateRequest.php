<?php

namespace App\Http\Requests\Painel\Usuario;

use Illuminate\Foundation\Http\FormRequest;
use App\Libraries\Contato\ContatoRequestTrait;

class UsuarioUpdateRequest extends FormRequest
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
        $usuarioId = $this->user()->id;

        return array_merge([
            'nome'          => 'required|string|max:255',
            'email'         => "required|string|email|max:255|unique:usuarios,email,{$usuarioId}",
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'senha'         => 'nullable|string|min:8',
        ], $this->contatoRules());
    }

    public function attributes()
    {
        return $this->contatoAttributes();
    }
}
