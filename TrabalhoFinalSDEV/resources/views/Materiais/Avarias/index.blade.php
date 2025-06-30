@extends('layouts.dashboard')

@section('content')
<div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4 font-mono">
    <a href="{{ route('materiais.home') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono"> &lt;CONSULTAR AVARIAS E MANUTENÇÃO/&gt;</h1>
</div>
<main class="px-4 md:px-8 font-mono">
    <div class="max-w-7xl mx-auto font-mono">
        <div class="flex justify-end mb-8 mt-6 font-mono">
            <a href="{{ route('avarias.create') }}" class=" bg-sky-800  text-white px-6 py-3 rounded hover:bg-slate-700 font-semibold transition-colors shadow font-mono">
                RESGISTAR NOVA AVARIA
            </a>
        </div>
        <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 shadow-lg font-mono">
            @if(session('success'))
                <div class="mb-6 text-center font-bold bg-green-100 text-green-800 border border-green-300 rounded py-3 px-6 font-mono">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('avarias.index') }}" class="w-full flex flex-col gap-6 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600 font-mono">
                <div class="w-full flex flex-col font-mono">
                    <label for="search" class="block text-base font-semibold text-blue-200 mb-3 font-mono">PESQUISAR</label>
                    <input type="text" name="search" id="search" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono" placeholder="Pesquisar por nº série, marca, modelo..." value="{{ request('search') }}">
                </div>
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-center w-full pt-4 font-mono">
                    <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center font-mono">FILTRAR</button>
                    <a href="{{ route('avarias.index') }}" class="px-8 py-3 bg-slate-700 hover:bg-sky-800 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center font-mono">LIMPAR FILTROS</a>
                </div>
            </form>
            <div class="overflow-x-auto font-mono">
                <table class="w-full min-w-[1000px] divide-y divide-slate-600 rounded-lg overflow-hidden font-mono">
                    <thead class="bg-slate-800 font-mono">
                        <tr>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">ID Avaria</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Nº Série</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Categoria</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Marca</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Modelo</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Estado</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Observações</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Data</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-600 font-mono">
                        @forelse($avarias as $avaria)
                            <tr class="hover:bg-slate-800 transition-colors {{ $loop->even ? 'bg-slate-700' : 'bg-slate-600' }} font-mono">
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->cod_avaria }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->material->num_serie ?? '-' }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->material->categoria->categoria ?? '-' }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->material->marca->marca ?? '-' }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->material->modelo->modelo ?? '-' }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->material->estado->estado_nome ?? '-' }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->observacoes }}</td>
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $avaria->data_registo ? \Carbon\Carbon::parse($avaria->data_registo)->format('d/m/Y') : '-' }}</td>
                                <td class="px-4 py-3 font-mono">
                                    <div class="flex flex-col md:flex-row gap-2 justify-center items-center font-mono">
                                        <a href="{{ route('avarias.edit', $avaria->cod_avaria) }}" class="bg-sky-800 text-white00 text-white px-3 py-1 rounded hover:bg-slate-700 text-xs font-mono">Editar</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-8 text-center text-slate-400 text-lg font-mono">Nenhuma avaria registada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-10 pt-6 border-t border-slate-600 flex justify-center font-mono">
                {{ $avarias->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</main>
@endsection
