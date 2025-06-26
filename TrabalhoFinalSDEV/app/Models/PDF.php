<?php

namespace App\Models;

class PDF
{
    /**
     * Gera um array de dados relevantes para PDF de um serviço/evento.
     */
    public static function dadosServico(Servico $servico)
    {
        $cliente = $servico->cliente;
        $tipo = $servico->tipoServico;
        $local = $servico->localizacao;

        $dados = [
            'nome_cliente' => $cliente->nome ?? '-',
            'email_cliente' => $cliente->mail ?? '-',
            'telefone_cliente' => $cliente->telefone ?? '-',
            'nome_servico' => $servico->nome_servico ?? '-',
            'data_inicio' => $servico->data_inicio ? $servico->data_inicio->format('d/m/Y') : '-',
            'data_fim' => $servico->data_fim ? $servico->data_fim->format('d/m/Y') : '-',
            'tipo_evento' => $tipo->nome_tipo ?? '-',
            'local' => $local->nome_local ?? '-',
        ];

        // Detalhes específicos por tipo de evento
        $tipoNome = strtolower($tipo->nome_tipo ?? '');
        switch ($tipoNome) {
            case 'casamento':
                $detalhes = $servico->detalhesCasamento;
                $dados['detalhes'] = $detalhes ? $detalhes->toArray() : [];
                break;
            case 'batizado':
                $detalhes = $servico->detalhesBatizado;
                $dados['detalhes'] = $detalhes ? $detalhes->toArray() : [];
                break;
            case 'comunhao geral':
                $detalhes = $servico->detalhesComunhaoGeral;
                $dados['detalhes'] = $detalhes ? $detalhes->toArray() : [];
                break;
            case 'comunhao particular':
                $detalhes = $servico->detalhesComunhaoParticular;
                $dados['detalhes'] = $detalhes ? $detalhes->toArray() : [];
                break;
            case 'evento corporativo':
                $detalhes = $servico->detalhesEVCorporativo;
                $dados['detalhes'] = $detalhes ? $detalhes->toArray() : [];
                break;
            default:
                $dados['detalhes'] = [];
        }
        return $dados;
    }
}
