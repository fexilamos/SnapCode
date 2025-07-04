@extends('layouts.dashboard')

@section('content')
    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4 font-mono">
        <a href="{{ route('servicos.checkin.home') }}"
            class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono">&lt;RELATÓRIOS PÓS-EVENTO/&gt;</h1>
    </div>
    <main class="px-4 md:px-8 font-mono">
        <div class="max-w-7xl mx-auto font-mono">
            <!-- Filtro de pesquisa -->
            <form method="GET" action="{{ route('servicos.relatorios.index') }}"
                class="w-full flex flex-col gap-6 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600 font-mono">
                <div class="w-full flex flex-col">
                    <label for="search" class="block text-base font-semibold text-blue-200 mb-3 font-mono">
                        PESQUISAR RELATÓRIO
                    </label>
                    <input type="text" name="search" id="search"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono"
                        placeholder="Pesquisar por evento" value="{{ request('search') }}">
                </div>
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-center w-full pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white font-mono rounded-lg font-semibold shadow transition-all duration-200 text-center">FILTRAR</button>
                    <a href="{{ route('servicos.relatorios.index') }}"
                        class="px-8 py-3 bg-slate-700 hover:bg-sky-800 font-mono text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">LIMPAR
                        FILTROS</a>
                </div>
            </form>
            <!-- Resultados -->
            <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 mt-10 shadow-xl font-mono">
                <h3 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide text-center font-mono">LISTA DE RELATÓRIOS
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px] divide-y divide-slate-600 rounded-lg overflow-hidden font-mono">
                        <thead class="bg-slate-800">
                            <tr>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Evento</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Data do Evento</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Data Check-In</th>
                                <th class="px-4 py-3 text-center text-blue-300 font-semibold uppercase tracking-wider font-mono">
                                    Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($relatorios as $relatorio)
                                <tr class="border-b border-slate-600 hover:bg-slate-600 transition font-mono">
                                    <td class="px-4 py-2 font-mono">
                                        {{ $relatorio->servico->nome_servico ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        {{ $relatorio->servico->data_inicio ? \Carbon\Carbon::parse($relatorio->servico->data_inicio)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 font-mono">
                                        @php
                                            // Supondo que data de check-in é data_devolucao do primeiro kit devolvido
                                            $dataCheckin = null;
                                            if ($relatorio->servico->kits->count()) {
                                                foreach($relatorio->servico->kits as $kit) {
                                                    if ($kit->pivot->data_devolucao) {
                                                        $dataCheckin = $kit->pivot->data_devolucao;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        {{ $dataCheckin ? \Carbon\Carbon::parse($dataCheckin)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2 font-mono text-center">
                                        <a href="{{ route('servicos.relatorios.show', $relatorio->id) }}"
                                            class="w-10 h-10 flex items-center justify-center bg-sky-800 hover:bg-slate-700 text-white rounded font-mono shadow transition"
                                            title="Ver Relatório">
                                            <img src="{{ asset('images/pesquisar.png') }}" alt="Ver" class="w-5 h-5" />
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-4 py-2 text-center text-slate-400 font-mono border-b border-slate-600">
                                        Nenhum relatório encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
