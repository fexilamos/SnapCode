<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateServicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nome_cliente'      => 'sometimes|required|string|max:255',
            'email_cliente'     => 'nullable|email',
            'telefone_cliente'  => 'nullable|string|max:20',
            'cod_tipo_servico'  => 'required|exists:TiposServico,cod_tipo_servico',
            'cod_local_servico' => 'required|exists:Localizacoes,cod_local_servico',
            'data_inicio'       => 'required|date',
            'data_fim'          => 'required|date|after_or_equal:data_inicio',
            'nome_servico'      => 'required|string|max:255',
            'detalhes'          => 'nullable|array',
            'detalhes.*'        => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'nome_cliente.required'       => 'O nome do cliente é obrigatório.',
            'email_cliente.email'         => 'O email do cliente deve ser válido.',
            'cod_tipo_servico.required'   => 'O tipo de serviço é obrigatório.',
            'cod_tipo_servico.exists'     => 'Tipo de serviço inválido.',
            'cod_local_servico.required'  => 'O local do serviço é obrigatório.',
            'cod_local_servico.exists'    => 'Local de serviço inválido.',
            'data_inicio.required'        => 'A data de início é obrigatória.',
            'data_inicio.date'            => 'A data de início deve ser válida.',
            'data_fim.required'           => 'A data de fim é obrigatória.',
            'data_fim.date'               => 'A data de fim deve ser válida.',
            'data_fim.after_or_equal'     => 'A data de fim deve ser igual ou posterior à data de início.',
            'nome_servico.required'       => 'O nome do serviço é obrigatório.',
            'nome_servico.max'            => 'O nome do serviço não pode ter mais de 255 caracteres.',
        ];
    }
}
