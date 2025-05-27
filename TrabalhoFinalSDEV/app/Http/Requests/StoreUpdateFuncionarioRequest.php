<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateFuncionarioRequest extends FormRequest
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
         $cod_funcionario = $this->route('funcionario');

        return [
            'nome'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users,email', Rule::unique('users', 'email')->ignore($cod_funcionario, 'cod_funcionario'),
            'nif'         => 'required|digits:9',
            'telemovel'   => 'required|string|max:20',
            'cod_funcao'  => 'required|exists:Funcoes,cod_funcao',
            'cod_estado'  => 'required|exists:FuncionarioEstados,cod_estado',
            'cod_nivel'   => 'required|exists:Niveis,cod_nivel',
        ];
    }

    public function messages()
{
    return [
        'nome.required'         => 'O nome é obrigatório.',
        'email.required'        => 'O email é obrigatório.',
        'email.email'           => 'O email não é válido.',
        'nif.required'          => 'O NIF é obrigatório.',
        'nif.digits'            => 'O NIF deve ter exatamente 9 dígitos.',
        'telemovel.required'    => 'O telemóvel é obrigatório.',
        'cod_funcao.required'   => 'A função é obrigatória.',
        'cod_funcao.exists'     => 'Função inválida.',
        'cod_estado.required'   => 'O estado é obrigatório.',
        'cod_estado.exists'     => 'Estado inválido.',
        'cod_nivel.required'    => 'O nível é obrigatório.',
        'cod_nivel.exists'      => 'Nível inválido.',
    ];
}
}
