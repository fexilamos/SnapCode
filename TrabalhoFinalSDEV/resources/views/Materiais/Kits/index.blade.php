@extends('layouts.dashboard')

@section('content')
<div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4">
    <a href="{{ route('kits.home') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono">&lt;CONSULTA DE KITS/&gt;</h1>
</div>

<main class="px-4 md:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Filtros -->
        <form method="GET" action="{{ route('kits.index') }}" class="w-full flex flex-col gap-6 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600">
            <div class="w-full flex flex-col">
                <label for="search" class="block text-base font-semibold text-blue-200 mb-3 font-mono">PESQUISAR POR NOME DO KIT</label>
                <input type="text" name="search" id="search" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono" placeholder="introduza um nome do kit" value="{{ request('search') }}">
            </div>
            <div class="w-full flex flex-col">
                <label for="categoria" class="block text-base font-semibold text-blue-200 mb-3 font-mono">CATEGORIA DE MATERIAL</label>
                <select name="categoria" id="categoria" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent font-mono">
                    <option value="">-- Todas as categorias --</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->cod_categoria }}" {{ request('categoria') == $categoria->cod_categoria ? 'selected' : '' }}>
                            {{ $categoria->categoria }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-center w-full pt-4">
                <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white font-mono rounded-lg font-semibold shadow transition-all duration-200 text-center">FILTRAR</button>
                <a href="{{ route('kits.index') }}" class="px-8 py-3 bg-slate-700 hover:bg-sky-800 font-mono text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">LIMPAR FILTROS</a>
            </div>
        </form>

        <!-- Resultados -->
        <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 mt-10 shadow-xl">
            <h3 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide text-center font-mono">LISTA DE KITS</h3>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px] divide-y divide-slate-600 rounded-lg overflow-hidden">
                    <thead class="bg-slate-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">ID</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Nome do Kit</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Materiais Incluídos</th>
                            <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider font-mono">Opções</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-600">
                        @forelse($kits as $kit)
                            <tr class="hover:bg-slate-800 transition-colors {{ $loop->even ? 'bg-slate-700' : 'bg-slate-600' }}">
                                <td class="px-4 py-3 text-white text-center align-middle font-mono">{{ $kit->cod_kit }}</td>
                                <td class="px-4 py-3 text-white align-middle font-mono">{{ $kit->nome_kit }}</td>
                                <td class="px-4 py-3 text-white align-middle font-mono">
                                    @forelse($kit->materiais as $material)
                                        @php
                                            $info = trim(
                                                ($material->marca->marca ?? '') . ' ' .
                                                ($material->modelo->modelo ?? '')
                                            );
                                            $categoria = $material->categoria->categoria ?? '';
                                        @endphp
                                        <span class="inline-block bg-slate-800 px-3 py-1 rounded-lg mb-1 mr-1 text-xs text-sky-300 shadow border border-slate-500">
                                            {{-- Marca + Modelo --}}
                                            {{ $info ?: $material->cod_material }}
                                            {{-- Categoria (opcional) --}}
                                            @if($categoria)
                                                <span class="text-slate-400 ml-1">[{{ $categoria }}]</span>
                                            @endif
                                            {{-- Número de série (opcional, podes tirar se não quiseres) --}}
                                            <span class="text-slate-400 ml-1">({{ $material->num_serie }})</span>
                                        </span>
                                    @empty
                                        <span class="text-slate-400">Sem materiais.</span>
                                    @endforelse
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                                        <a href="{{ route('kits.edit', $kit->cod_kit) }}" class="bg-sky-800 text-white px-3 py-1 rounded hover:bg-slate-700 text-xs">Editar</a>
                                        <form action="{{ route('kits.destroy', $kit->cod_kit) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-slate-800 text-white px-3 py-1 rounded hover:bg-slate-700 text-xs" onclick="return confirm('Tem a certeza que deseja eliminar este kit? Esta ação é irreversível!')">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-slate-400 text-lg">Nenhum kit encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-10 pt-6 border-t border-slate-600 flex justify-center">
                {{ $kits->appends(request()->except('page'))->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</main>
@endsection
