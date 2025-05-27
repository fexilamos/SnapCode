<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'materiais' => 'nullable|array',
            'materiais.*.data_devolucao' => 'required|date',

        ];
    }

    public function messages()
    {
        return [
            'materiais.*.data_devolucao.required' => 'A data de devolução é obrigatória.',
            'materiais.*.data_devolucao.date' => 'A data de devolução deve ser válida.',

        ];
    }
}
