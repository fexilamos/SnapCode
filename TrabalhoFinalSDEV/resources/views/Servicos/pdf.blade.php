<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Serviço</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f3f4f6; color: #222; margin: 0; }
        .pdf-container {
            max-width: 900px;
            margin: 32px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 40px 32px 32px 32px;
        }
        .logo {
            display: block;
            margin: 0 auto 24px auto;
            max-width: 180px;
        }
        h1 {
            color: #1a237e;
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 32px;
        }
        h2 {
            color: #2563eb;
            font-size: 1.3rem;
            margin-bottom: 12px;
            margin-top: 32px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 18px;
            background: #f9fafb;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 10px 14px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 1rem;
        }
        th {
            background: #e0e7ff;
            color: #1e293b;
            text-align: left;
            font-weight: 600;
        }
        tr:last-child td, tr:last-child th {
            border-bottom: none;
        }
        .section {
            margin-bottom: 32px;
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <img src="{{ public_path('images/LOGO.png') }}" alt="Logo Snap" class="logo">
        <h1>Detalhes do Evento</h1>

        <div class="section">
            <h2>Dados do Cliente</h2>
            <table>
                <tr><th>Nome</th><td>{{ $servico->cliente->nome ?? '-' }}</td></tr>
                <tr><th>Email</th><td>{{ $servico->cliente->mail ?? '-' }}</td></tr>
                <tr><th>Telefone</th><td>{{ $servico->cliente->telefone ?? '-' }}</td></tr>
            </table>
        </div>

        <div class="section">
            <h2>Dados do Evento</h2>
            <table>
                <tr><th>Nome do Serviço</th><td>{{ $servico->nome_servico ?? '-' }}</td></tr>
                <tr><th>Data Início</th><td>{{ $servico->data_inicio ? $servico->data_inicio->format('d/m/Y') : '-' }}</td></tr>
                <tr><th>Data Fim</th><td>{{ $servico->data_fim ? $servico->data_fim->format('d/m/Y') : '-' }}</td></tr>
                <tr><th>Tipo de Evento</th><td>{{ $servico->tipoServico->nome_tipo ?? '-' }}</td></tr>
                <tr><th>Local</th><td>{{ $servico->localizacao->nome_local ?? '-' }}</td></tr>
            </table>
        </div>

        <!-- Campos dinâmicos por tipo de evento -->
        @if($servico->tipoServico && strtolower($servico->tipoServico->nome_tipo) == 'casamento')
            <div class="section">
                <h2>Detalhes do Casamento</h2>
                <table>
                    <tr><th>Noivo</th><td>{{ $servico->detalhesCasamento->noivo ?? '-' }}</td></tr>
                    <tr><th>Nome do Noivo</th><td>{{ $servico->detalhesCasamento->nome_noivo ?? '-' }}</td></tr>
                    <tr><th>Morada Noivo</th><td>{{ $servico->detalhesCasamento->morada_noivo ?? '-' }}</td></tr>
                    <tr><th>Noiva</th><td>{{ $servico->detalhesCasamento->noiva ?? '-' }}</td></tr>
                    <tr><th>Nome da Noiva</th><td>{{ $servico->detalhesCasamento->nome_noiva ?? '-' }}</td></tr>
                    <tr><th>Morada Noiva</th><td>{{ $servico->detalhesCasamento->morada_noiva ?? '-' }}</td></tr>
                    <tr><th>Padrinhos</th><td>{{ $servico->detalhesCasamento->padrinhos ?? '-' }}</td></tr>
                    <tr><th>Fotos</th><td>{{ $servico->detalhesCasamento->fotos ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Vídeo</th><td>{{ $servico->detalhesCasamento->video ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Drone</th><td>{{ $servico->detalhesCasamento->drone ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>SDE</th><td>{{ $servico->detalhesCasamento->sde ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Fotos Convidados</th><td>{{ $servico->detalhesCasamento->fotos_convidados ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Nº Convidados Fotos</th><td>{{ $servico->detalhesCasamento->num_convidados_fotos ?? '-' }}</td></tr>
                    <tr><th>Venda Fotos</th><td>{{ $servico->detalhesCasamento->venda_fotos ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Hora Chegada Casa Noivo</th><td>{{ $servico->detalhesCasamento->hora_chegada_casa_noivo ?? '-' }}</td></tr>
                    <tr><th>Hora Saída Casa Noivo</th><td>{{ $servico->detalhesCasamento->hora_saida_casa_noivo ?? '-' }}</td></tr>
                    <tr><th>Agregado Noivo</th><td>{{ $servico->detalhesCasamento->agregado_noivo ?? '-' }}</td></tr>
                    <tr><th>Info Extra Noivo</th><td>{{ $servico->detalhesCasamento->info_extra_noivo ?? '-' }}</td></tr>
                    <tr><th>Hora Chegada Casa Noiva</th><td>{{ $servico->detalhesCasamento->hora_chegada_casa_noiva ?? '-' }}</td></tr>
                    <tr><th>Agregado Noiva</th><td>{{ $servico->detalhesCasamento->agregado_noiva ?? '-' }}</td></tr>
                    <tr><th>Info Extra Noiva</th><td>{{ $servico->detalhesCasamento->info_extra_noiva ?? '-' }}</td></tr>
                    <tr><th>Morada Igreja</th><td>{{ $servico->detalhesCasamento->morada_igreja ?? '-' }}</td></tr>
                    <tr><th>Instruções Igreja</th><td>{{ $servico->detalhesCasamento->instrucoes_igreja ?? '-' }}</td></tr>
                    <tr><th>Coro</th><td>{{ $servico->detalhesCasamento->coro ?? '-' }}</td></tr>
                    <tr><th>Coro Localização</th><td>{{ $servico->detalhesCasamento->coro_localizacao ?? '-' }}</td></tr>
                    <tr><th>Grupo Exterior</th><td>{{ $servico->detalhesCasamento->grupo_exterior ?? '-' }}</td></tr>
                    <tr><th>Info Extra Igreja</th><td>{{ $servico->detalhesCasamento->info_extra_igreja ?? '-' }}</td></tr>
                    <tr><th>Nome Quinta</th><td>{{ $servico->detalhesCasamento->nome_quinta ?? '-' }}</td></tr>
                    <tr><th>Morada Quinta</th><td>{{ $servico->detalhesCasamento->morada_quinta ?? '-' }}</td></tr>
                    <tr><th>Instruções Quinta</th><td>{{ $servico->detalhesCasamento->instrucoes_quinta ?? '-' }}</td></tr>
                    <tr><th>Info Extra Quinta</th><td>{{ $servico->detalhesCasamento->info_extra_quinta ?? '-' }}</td></tr>
                    <tr><th>Observações</th><td>{{ $servico->detalhesCasamento->observacoes ?? '-' }}</td></tr>
                </table>
            </div>
        @elseif($servico->tipoServico && strtolower($servico->tipoServico->nome_tipo) == 'batizado')
            <div class="section">
                <h2>Detalhes do Batizado</h2>
                <table>
                    <tr><th>Nome do Bebé</th><td>{{ $servico->detalhesBatizado->nome_bebe ?? '-' }}</td></tr>
                    <tr><th>Morada Bebé</th><td>{{ $servico->detalhesBatizado->morada_bebe ?? '-' }}</td></tr>
                    <tr><th>Fotos Convidados</th><td>{{ $servico->detalhesBatizado->fotos_convidados ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Nº Convidados Fotos</th><td>{{ $servico->detalhesBatizado->num_convidados_fotos ?? '-' }}</td></tr>
                    <tr><th>Venda Fotos</th><td>{{ $servico->detalhesBatizado->venda_fotos ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Hora Chegada Casa</th><td>{{ $servico->detalhesBatizado->hora_chegada_casa_bebe ?? '-' }}</td></tr>
                    <tr><th>Hora Saída Casa</th><td>{{ $servico->detalhesBatizado->hora_saida_casa_bebe ?? '-' }}</td></tr>
                    <tr><th>Agregado Bebé</th><td>{{ $servico->detalhesBatizado->agregado_bebe ?? '-' }}</td></tr>
                    <tr><th>Info Extra</th><td>{{ $servico->detalhesBatizado->info_extra_bebe ?? '-' }}</td></tr>
                    <tr><th>Morada Igreja</th><td>{{ $servico->detalhesBatizado->morada_igreja ?? '-' }}</td></tr>
                    <tr><th>Instruções Igreja</th><td>{{ $servico->detalhesBatizado->instrucoes_igreja ?? '-' }}</td></tr>
                    <tr><th>Coro</th><td>{{ $servico->detalhesBatizado->coro ?? '-' }}</td></tr>
                    <tr><th>Coro Localização</th><td>{{ $servico->detalhesBatizado->coro_localizacao ?? '-' }}</td></tr>
                    <tr><th>Grupo Exterior</th><td>{{ $servico->detalhesBatizado->grupo_exterior ?? '-' }}</td></tr>
                    <tr><th>Info Extra Igreja</th><td>{{ $servico->detalhesBatizado->info_extra_igreja ?? '-' }}</td></tr>
                    <tr><th>Nome Quinta</th><td>{{ $servico->detalhesBatizado->nome_quinta ?? '-' }}</td></tr>
                    <tr><th>Morada Quinta</th><td>{{ $servico->detalhesBatizado->morada_quinta ?? '-' }}</td></tr>
                    <tr><th>Instruções Quinta</th><td>{{ $servico->detalhesBatizado->instrucoes_quinta ?? '-' }}</td></tr>
                    <tr><th>Info Extra Quinta</th><td>{{ $servico->detalhesBatizado->info_extra_quinta ?? '-' }}</td></tr>
                    <tr><th>Observações</th><td>{{ $servico->detalhesBatizado->observacoes ?? '-' }}</td></tr>
                </table>
            </div>
        @elseif($servico->tipoServico && strtolower($servico->tipoServico->nome_tipo) == 'comunhao geral')
            <div class="section">
                <h2>Detalhes da Comunhão Geral</h2>
                <table>
                    <tr><th>Nº Crianças</th><td>{{ $servico->detalhesComunhaoGeral->num_criancas ?? '-' }}</td></tr>
                    <tr><th>Formato Fotos</th><td>{{ $servico->detalhesComunhaoGeral->formato_fotos ?? '-' }}</td></tr>
                    <tr><th>Valor Foto</th><td>{{ $servico->detalhesComunhaoGeral->valor_foto ?? '-' }}</td></tr>
                    <tr><th>Formato Vídeo</th><td>{{ $servico->detalhesComunhaoGeral->formato_video ?? '-' }}</td></tr>
                    <tr><th>Valor Vídeo</th><td>{{ $servico->detalhesComunhaoGeral->valor_video ?? '-' }}</td></tr>
                    <tr><th>Fotos</th><td>{{ $servico->detalhesComunhaoGeral->fotos ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Vídeo</th><td>{{ $servico->detalhesComunhaoGeral->video ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Drone</th><td>{{ $servico->detalhesComunhaoGeral->drone ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>SDE</th><td>{{ $servico->detalhesComunhaoGeral->sde ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Hora Chegada Igreja</th><td>{{ $servico->detalhesComunhaoGeral->hora_chegada_igreja ?? '-' }}</td></tr>
                    <tr><th>Info Extra Comunhão</th><td>{{ $servico->detalhesComunhaoGeral->info_extra_comunhao ?? '-' }}</td></tr>
                    <tr><th>Coro</th><td>{{ $servico->detalhesComunhaoGeral->coro ?? '-' }}</td></tr>
                    <tr><th>Coro Localização</th><td>{{ $servico->detalhesComunhaoGeral->coro_localizacao ?? '-' }}</td></tr>
                    <tr><th>Diplomas</th><td>{{ $servico->detalhesComunhaoGeral->diplomas ?? '-' }}</td></tr>
                    <tr><th>Grupo Exterior</th><td>{{ $servico->detalhesComunhaoGeral->grupo_exterior ?? '-' }}</td></tr>
                    <tr><th>Observações</th><td>{{ $servico->detalhesComunhaoGeral->observacoes ?? '-' }}</td></tr>
                </table>
            </div>
        @elseif($servico->tipoServico && strtolower($servico->tipoServico->nome_tipo) == 'comunhao particular')
            <div class="section">
                <h2>Detalhes da Comunhão Particular</h2>
                <table>
                    <tr><th>Nome da Criança</th><td>{{ $servico->detalhesComunhaoParticular->nome_crianca ?? '-' }}</td></tr>
                    <tr><th>Morada Criança</th><td>{{ $servico->detalhesComunhaoParticular->morada_crianca ?? '-' }}</td></tr>
                    <tr><th>Fotos Convidados</th><td>{{ $servico->detalhesComunhaoParticular->fotos_convidados ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Nº Convidados Fotos</th><td>{{ $servico->detalhesComunhaoParticular->num_convidados_fotos ?? '-' }}</td></tr>
                    <tr><th>Venda Fotos</th><td>{{ $servico->detalhesComunhaoParticular->venda_fotos ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Hora Chegada Casa Criança</th><td>{{ $servico->detalhesComunhaoParticular->hora_chegada_casa_crianca ?? '-' }}</td></tr>
                    <tr><th>Hora Saída Casa Criança</th><td>{{ $servico->detalhesComunhaoParticular->hora_saida_casa_crianca ?? '-' }}</td></tr>
                    <tr><th>Agregado Criança</th><td>{{ $servico->detalhesComunhaoParticular->agregado_crianca ?? '-' }}</td></tr>
                    <tr><th>Info Extra Criança</th><td>{{ $servico->detalhesComunhaoParticular->info_extra_crianca ?? '-' }}</td></tr>
                    <tr><th>Morada Igreja</th><td>{{ $servico->detalhesComunhaoParticular->morada_igreja ?? '-' }}</td></tr>
                    <tr><th>Instruções Igreja</th><td>{{ $servico->detalhesComunhaoParticular->instrucoes_igreja ?? '-' }}</td></tr>
                    <tr><th>Coro</th><td>{{ $servico->detalhesComunhaoParticular->coro ?? '-' }}</td></tr>
                    <tr><th>Coro Localização</th><td>{{ $servico->detalhesComunhaoParticular->coro_localizacao ?? '-' }}</td></tr>
                    <tr><th>Grupo Exterior</th><td>{{ $servico->detalhesComunhaoParticular->grupo_exterior ?? '-' }}</td></tr>
                    <tr><th>Info Extra Igreja</th><td>{{ $servico->detalhesComunhaoParticular->info_extra_igreja ?? '-' }}</td></tr>
                    <tr><th>Nome Quinta</th><td>{{ $servico->detalhesComunhaoParticular->nome_quinta ?? '-' }}</td></tr>
                    <tr><th>Morada Quinta</th><td>{{ $servico->detalhesComunhaoParticular->morada_quinta ?? '-' }}</td></tr>
                    <tr><th>Instruções Quinta</th><td>{{ $servico->detalhesComunhaoParticular->instrucoes_quinta ?? '-' }}</td></tr>
                    <tr><th>Info Extra Quinta</th><td>{{ $servico->detalhesComunhaoParticular->info_extra_quinta ?? '-' }}</td></tr>
                    <tr><th>Observações</th><td>{{ $servico->detalhesComunhaoParticular->observacoes ?? '-' }}</td></tr>
                </table>
            </div>
        @elseif($servico->tipoServico && strtolower($servico->tipoServico->nome_tipo) == 'evento corporativo')
            <div class="section">
                <h2>Detalhes do Evento Corporativo</h2>
                <table>
                    <tr><th>Empresa</th><td>{{ $servico->detalhesEVCorporativo->empresa ?? '-' }}</td></tr>
                    <tr><th>Responsável</th><td>{{ $servico->detalhesEVCorporativo->responsavel ?? '-' }}</td></tr>
                    <tr><th>Fotos</th><td>{{ $servico->detalhesEVCorporativo->fotos ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Vídeo</th><td>{{ $servico->detalhesEVCorporativo->video ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Drone</th><td>{{ $servico->detalhesEVCorporativo->drone ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>SDE</th><td>{{ $servico->detalhesEVCorporativo->sde ? 'Sim' : 'Não' }}</td></tr>
                    <tr><th>Hora Chegada</th><td>{{ $servico->detalhesEVCorporativo->hora_chegada_corp ?? '-' }}</td></tr>
                    <tr><th>Info Extra</th><td>{{ $servico->detalhesEVCorporativo->info_extra_corp ?? '-' }}</td></tr>
                    <tr><th>Observações</th><td>{{ $servico->detalhesEVCorporativo->observacoes ?? '-' }}</td></tr>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
