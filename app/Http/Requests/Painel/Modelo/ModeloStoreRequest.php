<?php

namespace App\Http\Requests\Painel\Modelo;

use Illuminate\Foundation\Http\FormRequest;

class ModeloStoreRequest extends FormRequest
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
            'montadora_id' => 'required|exits:montadoras,id',
            'nome' => 'required|string|max:255',
        ];
    }
}
