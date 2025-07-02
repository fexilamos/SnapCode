<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Evento</title>
    <style>
        @page { margin: 20mm; }
        html, body {
            page-break-after: avoid !important;
            page-break-before: avoid !important;
            page-break-inside: avoid !important;
        }
        * {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        table, tr, td, th, div, section {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        body {
            font-family: monospace, 'Courier New', Courier;
            font-size: 13px;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
            color: #1e293b;
            background-color: #ffffff;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .header-box {
            text-align: center;
            padding: 20px;
            margin-bottom: 25px;
            border: 2px solid #64748b;
            background: #e0f2fe;
            border-radius: 6px;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .box {
            border: 1px solid #334155;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 20px;
            background: #f8fafc;
        }

        .box-title {
            background: #334155;
            color: #bfdbfe;
            padding: 12px 16px;
            border-radius: 6px 6px 0 0;
            margin: -16px -16px 16px -16px;
            font-size: 15px;
            font-weight: bold;
            border-bottom: none;
        }

        .section {
            margin-bottom: 10px;
            display: flex;
        }

        .label {
            width: 140px;
            font-weight: bold;
            color: #0f172a;
        }

        .value {
            flex: 1;
            color: #334155;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px 40px;
        }

        .compact-layout {
            display: flex;
            gap: 60px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .compact-layout .box {
            flex: 1;
            min-width: 300px;
            margin-bottom: 0;
        }

        .detalhes-box {
            border: 2px solid #475569;
            background: #ffffff;
            border-radius: 6px;
            margin-top: 50px;
        }

        .detalhes-box .box-title {
            background: #334155;
            color: #bfdbfe;
            padding: 12px 16px;
            border-radius: 6px 6px 0 0;
            margin: -16px -16px 16px -16px;
            border-bottom: none;
        }

        .no-details {
            text-align: center;
            color: #94a3b8;
            font-style: italic;
            padding: 20px;
        }

        .detalhes-box span, .detalhes-box strong {
            font-weight: bold !important;
            color: #1e293b !important;
        }

        @media print {
            body { padding: 10px; }
        }
    </style>
</head>
<body>
    <div class="header-box">
        <img src="{{ public_path('images/LOGO.png') }}" alt="Logo Snap" class="logo">
        <h1 style="background: #334155; color: #bfdbfe; padding: 12px; border-radius: 6px; font-size: 22px;">Detalhes do Evento</h1>
    </div>

    <div class="box">
        <div class="box-title">Informações Gerais</div>
        <div class="info-grid">
            <div class="section">
                <span class="label">Nome:</span>
                <span class="value">{{ $servico->nome_servico }}</span>
            </div>
            <div class="section">
                <span class="label">Tipo:</span>
                <span class="value">{{ $servico->tipoServico->nome_tipo ?? '-' }}</span>
            </div>
            <div class="section">
                <span class="label">Cliente:</span>
                <span class="value">{{ $servico->cliente->nome ?? '-' }}</span>
            </div>
             <div class="section">
                <span class="label">Mail:</span>
                <span class="value">{{ $servico->cliente->mail ?? '-' }}</span>
            </div>
             <div class="section">
                <span class="label">Telefone:</span>
                <span class="value">{{ $servico->cliente->telefone ?? '-' }}</span>
            </div>
            <div class="section">
                <span class="label">Local:</span>
                <span class="value">{{ $servico->localizacao->nome_local ?? '-' }}</span>
            </div>
            <div class="section">
                <span class="label">Data Início:</span>
                <span class="value">{{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</span>
            </div>
            <div class="section">
                <span class="label">Data Fim:</span>
                <span class="value">{{ \Carbon\Carbon::parse($servico->data_fim)->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>



    @if(isset($servico->observacoes) && $servico->observacoes)
    <div class="box">
        <div class="box-title">Observações</div>
        <div class="section">
            <span class="value">{{ $servico->observacoes }}</span>
        </div>
    </div>
    @endif

    {{-- QUEBRA DE PÁGINA PDF
    <div style="page-break-before: always;"></div> --}}

    <div class="box detalhes-box">
        <div class="box-title">Detalhes Específicos do Evento</div>
        @php $tipo_id = $servico->cod_tipo_servico; @endphp
        @switch($tipo_id)
            @case(1)
                @if ($servico->detalhesCasamento)
                    @include('servicos.partials.detalhes-casamento', [ 'detalhes' => $servico->detalhesCasamento, 'pdf' => true ])
                @else
                    <div class="no-details">
                        Sem detalhes registados para este evento de casamento.
                    </div>
                @endif
                @break
            @case(2)
                @if ($servico->detalhesBatizado)
                    @include('servicos.partials.detalhes-batizado', [ 'detalhes' => $servico->detalhesBatizado, 'pdf' => true ])
                @else
                    <div class="no-details">
                        Sem detalhes registados para este evento de batizado.
                    </div>
                @endif
                @break
            @case(3)
                @if ($servico->detalhesEvCorporativo)
                    @include('servicos.partials.detalhes-corporativo', [ 'detalhes' => $servico->detalhesEvCorporativo, 'pdf' => true ])
                @else
                    <div class="no-details">
                        Sem detalhes registados para este evento corporativo.
                    </div>
                @endif
                @break
            @case(4)
                @if ($servico->detalhesComunhaoParticular)
                    @include('servicos.partials.detalhes-comunhao-particular', [ 'detalhes' => $servico->detalhesComunhaoParticular, 'pdf' => true ])
                @else
                    <div class="no-details">
                        Sem detalhes registados para este evento de comunhão particular.
                    </div>
                @endif
                @break
            @case(5)
                @if ($servico->detalhesComunhaoGeral)
                    @include('servicos.partials.detalhes-comunhao-geral', [ 'detalhes' => $servico->detalhesComunhaoGeral, 'pdf' => true ])
                @else
                    <div class="no-details">
                        Sem detalhes registados para este evento de comunhão geral.
                    </div>
                @endif
                @break
            @default
                <div class="no-details">
                    Tipo de evento não reconhecido ou sem detalhes específicos disponíveis.
                </div>
        @endswitch
    </div>
</body>
</html>
