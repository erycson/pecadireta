<?php

namespace App\Http\Requests\Painel\Faq;

use Illuminate\Foundation\Http\FormRequest;

class FaqUpdateRequest extends FormRequest
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
            'tipo'     => 'required|in:1,2',
            'pergunta' => 'required|string|max:255',
            'resposta' => 'required|string',
        ];
    }
}
