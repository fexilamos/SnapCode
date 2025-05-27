<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePerdaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cod_material' => 'required|exists:Materiais,cod_material',
            'cod_servico' => 'required|exists:Servicos,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'cod_material.required' => 'É obrigatório selecionar um material.',
            'cod_material.exists' => 'O material selecionado não existe.',
            'cod_servico.required' => 'É obrigatório selecionar um serviço.',
            'cod_servico.exists' => 'O serviço selecionado não existe.',
            'data_registo.required' => 'A data de registo é obrigatória.',
            'data_registo.date' => 'A data de registo deve ser uma data válida.',
            'observacoes.max' => 'As observações não podem ter mais de 255 caracteres.',
        ];
    }
}
