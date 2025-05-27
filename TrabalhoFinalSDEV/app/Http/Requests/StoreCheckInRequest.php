<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Array de funcionários
            'funcionarios' => 'nullable|array',
            'funcionarios.*.data_alocacao_inicio' => 'nullable|date',
            'funcionarios.*.data_alocacao_fim'    => 'nullable|date|after_or_equal:funcionarios.*.data_alocacao_inicio',
            'funcionarios.*.funcao_no_servico'    => 'nullable|string|max:255',

            // Array de materiais
            'materiais' => 'nullable|array',
            'materiais.*.data_levantamento' => 'nullable|date',
            'materiais.*.data_devolucao'    => 'nullable|date|after_or_equal:materiais.*.data_levantamento',

        ];
    }

    public function messages()
    {
        return [
            'funcionarios.*.data_alocacao_inicio.date' => 'A data de início deve ser válida.',
            'funcionarios.*.data_alocacao_fim.date' => 'A data de fim deve ser válida.',
            'funcionarios.*.data_alocacao_fim.after_or_equal' => 'A data de fim deve ser igual ou posterior ao início.',
            'materiais.*.data_levantamento.date' => 'A data de levantamento deve ser válida.',
            'materiais.*.data_devolucao.date' => 'A data de devolução deve ser válida.',
            'materiais.*.data_devolucao.after_or_equal' => 'A data de devolução deve ser igual ou posterior ao levantamento.',
        ];
    }
}
