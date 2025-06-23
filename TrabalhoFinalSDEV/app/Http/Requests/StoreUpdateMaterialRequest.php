<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMaterialRequest extends FormRequest
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
            'cod_categoria' => 'required|exists:Categoria,cod_categoria',
            'cod_marca' => 'required|exists:Marca,cod_marca',
            'cod_modelo' => 'required|exists:Modelo,cod_modelo',
            'cod_estado' => 'required|exists:Material_Estado,cod_estado',
            'observacoes' => 'nullable|string|max:255'
        ];
    }

     public function messages()
    {
        return [
            'cod_categoria.required' => 'A categoria é obrigatória.',
            'cod_categoria.exists' => 'Categoria inválida.',
            'cod_marca.required' => 'A marca é obrigatória.',
            'cod_marca.exists' => 'Marca inválida.',
            'cod_modelo.required' => 'O modelo é obrigatório.',
            'cod_modelo.exists' => 'Modelo inválido.',
            'cod_estado.required' => 'O estado é obrigatório.',
            'cod_estado.exists' => 'Estado inválido.',
            'observacoes.max' => 'As observações não podem ter mais de 255 caracteres.',
        ];
    }
}
