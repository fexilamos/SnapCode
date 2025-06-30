@extends('layouts.dashboard')

@section('content')
<br>


<h1 class="text-3xl font-semibold mb-6 font-mono">PAINEL PRINCIPAL</h1>

<!-- Cards Superiores -->
<br>
<br>

<br>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Estatísticas de Eventos -->
    <div class="bg-gray-700 p-6 rounded-2xl shadow-xl">
        <h2 class="text-xl font-semibold font-mono mb-4 flex items-center gap-2">
            <img src="{{ asset('images/estatistica.png') }}" alt="Estatísticas" class="w-7 h-7 inline">ESTATÍSTICAS DE EVENTOS
        </h2>
        @php
            $tipos = [
                'Casamento' => 'Casamentos',
                'Batizado' => 'Batizados',
                'Comunhao Geral' => 'Comunhões Gerais',
                'Comunhao Particular' => 'Comunhões Particulares',
                'Evento Corporativo' => 'Eventos Corporativos',
            ];
            $contagens = [];
            foreach ($tipos as $tipo_bd => $tipo_label) {
                $contagens[$tipo_label] = \App\Models\Servico::whereHas('tipoServico', function($q) use ($tipo_bd) {
                    $q->where('nome_tipo', $tipo_bd);
                })->count();
            }
        @endphp
        <ul class="text-sm space-y-2 font-mono">
            <li class="flex items-center gap-2"><img src="{{ asset('images/casamentos.png') }}" alt="Casamentos" class="w-6 h-6 inline"> <strong>casamentos:</strong> {{ $contagens['Casamentos'] }}</li>
            <li class="flex items-center gap-2"><img src="{{ asset('images/batismo.png') }}" alt="Batizados" class="w-6 h-6 inline"> <strong>batizados:</strong> {{ $contagens['Batizados'] }}</li>
            <li class="flex items-center gap-2"><img src="{{ asset('images/comunhaogeral.png') }}" alt="Comunhões Gerais" class="w-6 h-6 inline"> <strong>comunhões gerais:</strong> {{ $contagens['Comunhões Gerais'] }}</li>
            <li class="flex items-center gap-2"><img src="{{ asset('images/comunhaopart.png') }}" alt="Comunhões Particulares" class="w-6 h-6 inline"> <strong>comunhões particulares:</strong> {{ $contagens['Comunhões Particulares'] }}</li>
            <li class="flex items-center gap-2"><img src="{{ asset('images/corporate.png') }}" alt="Eventos Corporativos" class="w-6 h-6 inline"> <strong>eventos corporativos:</strong> {{ $contagens['Eventos Corporativos'] }}</li>
        </ul>
        <a href="{{ url('/servicos') }}" class="text-blue-300 mt-3 font-mono inline-block hover:underline">ver todos os serviços →</a>
    </div>

    <!-- Funcionários em Serviço Hoje -->
    <div class="bg-gray-700 p-6 rounded-2xl shadow-xl">
        <h2 class="text-xl font-semibold font-mono mb-2 flex items-center gap-2">
            <img src="{{ asset('images/colab.png') }}" alt="Funcionários" class="w-7 h-7 inline">FUNCIONÁRIOS
        </h2>
        <ul class="text-sm space-y-1 font-mono">
            @php

    $funcionarios_externos = \App\Models\Funcionario::with('funcoes')
                    ->whereHas('funcoes', function($q) {
                        $q->where('funcao', '!=', 'Admin');
                    })->limit(4)->get();
            @endphp
            @forelse($funcionarios_externos as $funcionario)
                <li>
                    {{ $funcionario->nome }} –
                    {{ $funcionario->funcoes->pluck('funcao')->join('/') }}
                </li>
            @empty
                <li class="text-gray-400 font-mono">Nenhum funcionário externo encontrado.</li>
            @endforelse
        </ul>
        <a href="{{ route('funcionarios.index') }}" class="text-blue-300 mt-3 inline-block hover:underline font-mono">ver todos os funcionários →</a>
    </div>

    <!-- Materiais em Manutenção -->
    <div class="bg-gray-700 p-6 rounded-2xl shadow-xl">
        <h2 class="text-xl font-semibold mb-2 font-mono flex items-center gap-2">
            <img src="{{ asset('images/avarias.png') }}" alt="Manutenção" class="w-7 h-7 inline">MANUTENÇÃO
        </h2>
        <ul class="text-sm space-y-1 font-mono">
            @php
                $materiais_manutencao = \App\Models\Material::with(['estado','marca','modelo'])
                    ->whereHas('estado', function($q) {
                        $q->whereIn('estado_nome', ['Em Manutenção', 'Avariado']);
                    })->limit(4)->get();
            @endphp
            @forelse($materiais_manutencao as $material)
                <li>
                    {{ $material->cod_material }}
                    {{ $material->marca ? ' - ' . $material->marca->marca : '' }}
                    {{ $material->modelo ? ' ' . $material->modelo->modelo : '' }}
                    {{ $material->observacoes ? ' – ' . $material->observacoes : '' }}
                </li>
            @empty
                <li class="text-gray-400 font-mono">Nenhum material em manutenção.</li>
            @endforelse
        </ul>
        <a href="{{ route('avarias.index') }}" class="text-blue-300 mt-3 font-mono inline-block hover:underline">ver equipamento em manutenção →</a>
    </div>
</div>

<!-- Card Inferior - Eventos Recentes e Futuros -->
<div class="mt-8 bg-gray-700 p-6 rounded-2xl shadow-xl">
    <h2 class="text-xl font-semibold mb-4 flex items-center font-mono gap-2">
        <img src="{{ asset('images/calendario.png') }}" alt="Eventos Recentes e Futuros" class="w-7 h-7 inline font-mono">AGENDA
    </h2>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Passados -->
        <div>
            <h3 class="text-lg font-semibold mb-2 flex items-center gap-2 font-mono">
                <img src="{{ asset('images/relogio.png') }}" alt="Eventos Passados" class="w-6 h-6 inline ">EVENTOS PASSADOS
            </h3>
            <ul class="text-sm space-y-1 font-mono">
                @php
                    $eventos_passados = \App\Models\Servico::with(['tipoServico','localizacao'])
                        ->whereDate('data_fim', '<', now())
                        ->orderByDesc('data_fim')
                        ->limit(3)
                        ->get();
                @endphp
                @forelse($eventos_passados as $evento)
                    <li>
                        <span class="font-semibold">{{ $evento->tipoServico->nome_tipo ?? '-' }}</span>
                        – {{ $evento->nome_servico }} –
                        {{ $evento->data_fim ? $evento->data_fim->format('d M') : '-' }} –
                        {{ $evento->localizacao->nome_local ?? '-' }}
                    </li>
                @empty
                    <li class="text-gray-400 font-mono">Nenhum evento passado encontrado.</li>
                @endforelse
            </ul>
        </div>

        <!-- Futuros -->
        <div>
            <h3 class="text-lg font-semibold mb-2 flex items-center gap-2 font-mono">
                <img src="{{ asset('images/relogiobreve.png') }}" alt="Próximos Eventos" class="w-6 h-6 inline">PRÓXIMOS EVENTOS
            </h3>
            <ul class="text-sm space-y-1 font-mono">
                @php
                    $eventos_futuros = \App\Models\Servico::with(['tipoServico','localizacao'])
                        ->whereDate('data_inicio', '>=', now())
                        ->orderBy('data_inicio')
                        ->limit(3)
                        ->get();
                @endphp
                @forelse($eventos_futuros as $evento)
                    <li>
                        <span class="font-semibold">{{ $evento->tipoServico->nome_tipo ?? '-' }}</span>
                        – {{ $evento->nome_servico }} –
                        {{ $evento->data_inicio ? $evento->data_inicio->format('d M') : '-' }} –
                        {{ $evento->localizacao->nome_local ?? '-' }}
                    </li>
                @empty
                    <li class="text-gray-400">Nenhum evento futuro encontrado.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <div class="flex flex-row flex-wrap gap-4 mt-4">
        <a href="{{ url('/calendario') }}" class="text-blue-300 inline-block hover:underline font-mono">Ir para o calendário completo →</a>
        //
        <a href="{{ url('/servicos') }}" class="text-blue-300 inline-block hover:underline font-mono">Ir para Eventos →</a>
    </div>
    <br>
</div>
@endsection
