<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCreateFormResquest extends FormRequest
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
            'image' => 'required',
            'title' => 'required|min:5',
            'date' => 'required',
            'city' => 'required|min:3',
            'private' => 'required',
            'description' => 'required|min:10',
            'items' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'O campo "Imagem ilustrativa" é obrigatório',
            'title.required' => 'O campo "Viagem" é obrigatório',
            'date.required' => 'O campo "Data da Viagem" é obrigatório',
            'city.required' => 'O campo "Destino" é obrigatório',
            'private.required' => 'O campo "Vagas para um acompanhante" é obrigatório',
            'description.required' => 'O campo "Descrição" é obrigatório',
            'items.required' => 'O campo "O ônibus conta com" é obrigatório'
        ];
    }
}
