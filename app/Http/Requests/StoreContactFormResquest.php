<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactFormResquest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|min:6',
            'telefone' => 'required|min:8',
            'mensagem' => 'required|min:10|max:255',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'O campo "Nome" é obrigatório',
            'email.required' => 'O campo "Email" é obrigatório',
            'telefone.required' => 'O campo "Telefone" é obrigatório',
            'mensagem.required' => 'O campo "Sua mensagem" é obrigatório',
        ];
    }
}
