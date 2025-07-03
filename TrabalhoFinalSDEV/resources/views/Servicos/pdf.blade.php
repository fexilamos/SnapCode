<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Resumo do Evento</title>
    <style>
        @page { margin: 0; }
        html, body {
            margin: 0;
            padding: 0;
            width: 100vw;
            min-width: 100vw;
            min-height: 100vh;
            font-family: 'Fira Mono', 'JetBrains Mono', 'Courier New', Courier, monospace;
            background: #f4f6fb;
            color: #222;
        }
        .pdf-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px #0001;
            padding: 0 0 32px 0;
            overflow: hidden;
        /* }
        .pdf-header {
            background: #075985;
            color: #fff;
            padding: 36px 40px 24px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 18px; */
        }
        .pdf-header img {
            max-width: 110px;
            border-radius: 12px;
            background: #fff;
            padding: 6px;
            display: block;
            margin: 0 auto;
        }
        .pdf-header h1 {
            font-size: 2.7rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: 2px;
            text-align: center;
            font-family: inherit;
        }
        .pdf-section {
            padding: 36px 44px 0 44px;
        }
        .section-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #075985;
            margin-bottom: 22px;
            border-left: 6px solid #075985;
            padding-left: 16px;
            letter-spacing: 0.7px;
            font-family: inherit;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
        }
        .info-table th, .info-table td {
            text-align: left;
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-family: inherit;
        }
        .info-table th {
            color: #075985;
            font-size: 1.13rem;
            font-weight: 700;
            background: #f1f5f9;
        }
        .info-table td {
            font-size: 1.13rem;
        }
        .obs-box {
            background: #f1f5f9;
            border-left: 6px solid #075985;
            border-radius: 8px;
            padding: 16px 22px;
            margin: 22px 0 28px 0;
            font-size: 1.13rem;
            color: #222;
            font-family: inherit;
        }
        .detalhes-box {
            background: #f9fafb;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            margin-top: 22px;
            padding: 22px 28px 14px 28px;
        }
        .detalhes-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: #075985;
            margin-bottom: 14px;
            border-left: 5px solid #075985;
            padding-left: 12px;
            font-family: inherit;
        }
        .no-details {
            text-align: center;
            color: #888;
            font-style: italic;
            padding: 10px;
            background: none;
            border-radius: 8px;
            font-family: inherit;
        }
        /* Subtítulos dos partials */
        .pdf-subtitle, .detalhes-box strong, .detalhes-box .subtitle, .detalhes-box .label {
            font-weight: bold !important;
            font-size: 1.08em !important;
            color: #075985 !important;
            font-family: inherit !important;
        }
        @media print {
            html, body {
                margin: 0 !important;
                padding: 0 !important;
                width: 100vw;
                min-width: 100vw;
                min-height: 100vh;
            }
            .pdf-container, .detalhes-box, .obs-box {
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <div class="pdf-header">
            <img src="{{ public_path('images/LOGO.png') }}" alt="Logo Snap">
            {{-- <h1>Resumo do Evento</h1> --}}
        </div>
        <div class="pdf-section">

            <div class="section-title"> &lt;INFORMAÇÕES GERAIS/&gt;</div>
            <table class="info-table">
                <tr>
                    <th>Cliente</th>
                    <td>{{ $servico->cliente->nome ?? '-' }}</td>
                    <th>Tipo</th>
                    <td>{{ $servico->tipoServico->nome_tipo ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nome do Serviço</th>
                    <td>{{ $servico->nome_servico }}</td>
                    <th>Mail</th>
                    <td>{{ $servico->cliente->mail ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Telefone</th>
                    <td>{{ $servico->cliente->telefone ?? '-' }}</td>
                    <th>Local</th>
                    <td>{{ $servico->localizacao->nome_local ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Data Início</th>
                    <td>{{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</td>
                    <th>Data Fim</th>
                    <td>{{ \Carbon\Carbon::parse($servico->data_fim)->format('d/m/Y') }}</td>
                </tr>
            </table>
            @if(isset($servico->observacoes) && $servico->observacoes)
            <div class="obs-box">
                <strong>Observações:</strong> {{ $servico->observacoes }}
            </div>
            @endif
            <div class="detalhes-box">
                <div class="detalhes-title"> &lt;DETALHES DO EVENTOS/&gt;</div>
                @php $tipo_id = $servico->cod_tipo_servico; @endphp
                @if ($tipo_id == 1 && $servico->detalhesCasamento)
                    @include('servicos.partials.detalhes-casamento', [ 'detalhes' => $servico->detalhesCasamento, 'pdf' => true ])
                @elseif ($tipo_id == 2 && $servico->detalhesBatizado)
                    @include('servicos.partials.detalhes-batizado', [ 'detalhes' => $servico->detalhesBatizado, 'pdf' => true ])
                @elseif ($tipo_id == 3 && $servico->detalhesEvCorporativo)
                    @include('servicos.partials.detalhes-corporativo', [ 'detalhes' => $servico->detalhesEvCorporativo, 'pdf' => true ])
                @elseif ($tipo_id == 4 && $servico->detalhesComunhaoParticular)
                    @include('servicos.partials.detalhes-comunhao-particular', [ 'detalhes' => $servico->detalhesComunhaoParticular, 'pdf' => true ])
                @elseif ($tipo_id == 5 && $servico->detalhesComunhaoGeral)
                    @include('servicos.partials.detalhes-comunhao-geral', [ 'detalhes' => $servico->detalhesComunhaoGeral, 'pdf' => true ])
                @else
                    <div class="no-details">Sem detalhes registados para este evento.</div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
