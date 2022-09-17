<?php

namespace App\Http\Requests\Painel\Cep;

use Illuminate\Foundation\Http\FormRequest;

class CepStoreRequest extends FormRequest
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
            'cep'        => 'required|string|max:8',
            'uf'         => 'required|string|max:2',
            'municipio'  => 'required|string|max:50',
            'bairro'     => 'required|string|max:100',
            'tipo'       => 'required|string|max:100',
            'logradouro' => 'required|string|max:255',
        ];
    }
}
