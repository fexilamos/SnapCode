@extends('layouts.dashboard')

@section('content')
    <h1
        class="text-3xl font-extrabold text-center mt-14 mb-12 tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 drop-shadow-xl">
        Detalhes do Evento
    </h1>
    <div class="p-8 max-w-3xl mx-auto bg-slate-800/95 rounded-3xl shadow-2xl border border-slate-700">
        {{-- DEBUG Detalhes --}}
        @if (session('debug_detalhes'))
            <div class="mb-8 p-4 bg-yellow-900/80 text-yellow-200 rounded shadow text-xs overflow-x-auto">
                <strong>DEBUG Detalhes carregados:</strong>
                <pre>
Casamento: {{ print_r($servico->detalhesCasamento ? $servico->detalhesCasamento->toArray() : null, true) }}
Batizado: {{ print_r($servico->detalhesBatizado ? $servico->detalhesBatizado->toArray() : null, true) }}
Comunhao Geral: {{ print_r($servico->detalhesComunhaoGeral ? $servico->detalhesComunhaoGeral->toArray() : null, true) }}
Comunhao Particular: {{ print_r($servico->detalhesComunhaoParticular ? $servico->detalhesComunhaoParticular->toArray() : null, true) }}
Corporativo: {{ print_r($servico->detalhesEvCorporativo ? $servico->detalhesEvCorporativo->toArray() : null, true) }}
                </pre>
            </div>
        @endif

        {{-- Informações Gerais --}}
        <div class="mb-12">
            <h2 class="text-lg md:text-xl font-bold text-slate-100 mb-6 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-600/15">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </span>
                Informações Gerais
            </h2>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 text-slate-100">
                <div>
                    <dt class="font-semibold text-slate-400 text-sm">Nome</dt>
                    <dd class="mt-1 text-base">{{ $servico->nome_servico }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-400 text-sm">Tipo</dt>
                    <dd class="mt-1 text-base">{{ $servico->tipoServico->nome_tipo ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-400 text-sm">Cliente</dt>
                    <dd class="mt-1 text-base">{{ $servico->cliente->nome ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-400 text-sm">Local</dt>
                    <dd class="mt-1 text-base">{{ $servico->localizacao->nome_local ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-400 text-sm">Data Início</dt>
                    <dd class="mt-1 text-base">{{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-slate-400 text-sm">Data Fim</dt>
                    <dd class="mt-1 text-base">{{ \Carbon\Carbon::parse($servico->data_fim)->format('d/m/Y') }}</dd>
                </div>
            </dl>
        </div>

        {{-- Detalhes Específicos --}}
        <div class="mb-12">
            <h2 class="text-lg md:text-xl font-bold text-slate-100 mb-6 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-purple-600/15">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2" />
                    </svg>
                </span>
                Detalhes do Evento
            </h2>
            @php $tipo_id = $servico->cod_tipo_servico; @endphp
            @switch($tipo_id)
                @case(1)
                    {{-- Casamento --}}
                    @if ($servico->detalhesCasamento)
                        @include('servicos.partials.detalhes-casamento', [
                            'detalhes' => $servico->detalhesCasamento,
                        ])
                    @else
                        <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
                    @endif
                @break

                @case(2)
                    {{-- Batizado --}}
                    @if ($servico->detalhesBatizado)
                        @include('servicos.partials.detalhes-batizado', [
                            'detalhes' => $servico->detalhesBatizado,
                        ])
                    @else
                        <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
                    @endif
                @break

                @case(3)
                    {{-- Evento Corporativo --}}
                    @if ($servico->detalhesEvCorporativo)
                        @include('servicos.partials.detalhes-corporativo', [
                            'detalhes' => $servico->detalhesEvCorporativo,
                        ])
                    @else
                        <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
                    @endif
                @break

                @case(4)
                    {{-- Comunhão Particular --}}
                    @if ($servico->detalhesComunhaoParticular)
                        @include('servicos.partials.detalhes-comunhao-particular', [
                            'detalhes' => $servico->detalhesComunhaoParticular,
                        ])
                    @else
                        <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
                    @endif
                @break

                @case(5)
                    {{-- Comunhão Geral --}}
                    @if ($servico->detalhesComunhaoGeral)
                        @include('servicos.partials.detalhes-comunhao-geral', [
                            'detalhes' => $servico->detalhesComunhaoGeral,
                        ])
                    @else
                        <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
                    @endif
                @break

                @default
                    <div class="text-gray-300">Sem detalhes específicos.</div>
            @endswitch
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('servicos.tipo', ['tipo' => $tipo]) }}"
                class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-2xl shadow-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Voltar à Lista
            </a>
        </div>
    </div>
@endsection
