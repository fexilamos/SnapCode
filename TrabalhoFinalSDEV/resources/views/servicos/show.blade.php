@php $user = Auth::user();
$layout = $user && $user->funcionario && $user->funcionario->cod_nivel == 3 ? 'layouts.sidebar-funcionario' : 'layouts.dashboard';
@endphp
@extends($layout)

@section('content')
    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-start mb-6">
            @if($user->funcionario->cod_nivel == 3)
                <a href="{{ url()->previous() }}"
                    class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
            @else
                <a href="{{ route('servicos.tipo', ['tipo' => $tipo]) }}"
                    class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                   
                </a>
            @endif
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-center mt-8 mb-12 tracking-tight text-white drop-shadow-xl font-mono">
            Detalhes do Evento
        </h1>
    </div>
    <div class="p-8 max-w-3xl mx-auto bg-slate-800/95 rounded-3xl shadow-2xl border border-slate-700 font-mono">


        {{-- Informações Gerais --}}
        <div class="mb-12">
            <h2 class="text-lg md:text-xl font-bold text-slate-100 mb-6 flex items-center gap-3">
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
                    <dt class="font-semibold text-slate-400 text-sm">Mail</dt>
                    <dd class="mt-1 text-base">{{ $servico->cliente->mail ?? '-' }}</dd>
                </div>
                 <div>
                    <dt class="font-semibold text-slate-400 text-sm">Telefone</dt>
                    <dd class="mt-1 text-base">{{ $servico->cliente->telefone ?? '-' }}</dd>
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

        <div class="mt-12 flex flex-col md:flex-row justify-center items-center gap-4">
            @if($user->funcionario->cod_nivel != 3)
                <a href="{{ route('servicos.edit', ['servico' => $servico->cod_servico]) }}"
                    class="px-8 py-3 bg-sky-800 text-white font-semibold rounded-2xl shadow hover:bg-slate-700 transition-all duration-200 border border-sky-800">
                    Editar
                </a>
                <a href="{{ route('servicos.tipo', ['tipo' => $tipo]) }}"
                    class="px-8 py-3 bg-white text-slate-800 font-semibold rounded-2xl shadow hover:bg-slate-100 transition-all duration-200 border border-slate-200">
                    Voltar à Lista
                </a>
            @endif
            <a href="{{ route('servicos.pdf', ['id' => $servico->cod_servico]) }}"
                class="px-8 py-3 bg-slate-700 text-white font-semibold rounded-2xl shadow hover:bg-sky-800 transition-all duration-200 border border-slate-200">
                Criar PDF
            </a>
        </div>
    </div>
@endsection
