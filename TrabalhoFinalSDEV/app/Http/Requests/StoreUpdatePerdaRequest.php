<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePerdaRequest extends FormRequest
{
    
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
        // Validação de campos editáveis (Observações , cod_estado, data_registo, cod_serviço[opcional])
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'cod_estado' => 'required|exists:Material_Estado,cod_estado',
                'observacoes' => 'nullable|string|max:255',
                'data_registo' => 'required|date',
                'cod_servico' => 'nullable|exists:Servicos,cod_servico',
            ];
        }
        // Para criação mantém as regras antigas
        return [
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servicos,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string|max:255',
        ];
    }
}
