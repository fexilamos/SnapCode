<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateFuncionarioRequest extends FormRequest
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
         $cod_funcionario = $this->route('funcionario');

        return [
            'nome'        => 'required|string|max:255',
            'email'       => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($cod_funcionario, 'cod_funcionario'),
            ],
            'telemovel'   => 'required|string|max:20',
            'funcoes'     => 'required|array|min:1',
            'funcoes.*'   => 'exists:Funcao,cod_funcao',
            'cod_nivel'   => 'required|exists:Nivel,cod_nivel',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'         => 'O nome é obrigatório.',
            'email.required'        => 'O email é obrigatório.',
            'email.email'           => 'O email não é válido.',
            'telemovel.required'    => 'O telemóvel é obrigatório.',
            'funcoes.required'      => 'A função é obrigatória.',
            'funcoes.array'         => 'Selecione pelo menos uma função.',
            'funcoes.*.exists'      => 'Função inválida.',
            'cod_nivel.required'    => 'O nível é obrigatório.',
            'cod_nivel.exists'      => 'Nível inválido.',
        ];
    }
}
