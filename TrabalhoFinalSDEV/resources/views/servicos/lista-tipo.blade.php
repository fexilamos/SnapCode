@extends('layouts.dashboard')

@section('content')
    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4">
        <a href="{{ route('servicos.index') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono">CONSULTA DE EVENTOS</h1>
    </div>
    <main class="px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Filtro de pesquisa -->
            <form method="GET" action="{{ route('servicos.tipo', ['tipo' => $tipo]) }}" class="w-full flex flex-col gap-6 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600">
                <div class="w-full flex flex-col">
                    <label for="search" class="block text-base font-semibold text-blue-200 mb-3 font-mono">PESQUISAR</label>
                    <input type="text" name="search" id="search" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono" placeholder="Pesquisar por nome, cliente, local..." value="{{ request('search') }}">
                </div>
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-center w-full pt-4">
                    <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white font-mono rounded-lg font-semibold shadow transition-all duration-200 text-center">FILTRAR</button>
                    <a href="{{ route('servicos.tipo', ['tipo' => $tipo]) }}" class="px-8 py-3 bg-slate-700 hover:bg-sky-800 font-mono text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">LIMPAR FILTROS</a>
                </div>
            </form>
            <!-- Resultados -->
            <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 mt-10 shadow-xl">
                <h3 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide text-center font-mono">LISTA DE EVENTOS</h3>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[900px] divide-y divide-slate-600 rounded-lg overflow-hidden font-mono">
                        <thead class="bg-slate-800">
                            <tr>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Nome</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Cliente</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Data Início</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Local</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($servicos as $servico)
                                <tr class="border-b border-slate-600 hover:bg-slate-600 transition">
                                    <td class="px-4 py-2">{{ $servico->nome_servico }}</td>
                                    <td class="px-4 py-2">{{ $servico->cliente->nome ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2">{{ $servico->localizacao->nome_local ?? '-' }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex gap-2">
                                            <a href="{{ route('servicos.show', $servico->cod_servico) }}" class="px-4 py-2 bg-sky-800 hover:bg-slate-700 text-white rounded font-mono text-sm font-semibold shadow transition">Ver</a>
                                            <a href="{{ route('servicos.edit', $servico->cod_servico) }}" class="px-4 py-2 bg-slate-700 hover:bg-sky-800 text-white rounded font-mono text-sm font-semibold shadow transition">Editar</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-400 text-lg font-mono">Nenhum evento encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('servicos.index') }}" class="inline-block px-6 py-2 bg-sky-800 text-white rounded hover:bg-slate-700 transition font-mono">Voltar</a>
            </div>
        </div>
    </main>
@endsection
