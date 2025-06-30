@extends('layouts.dashboard')

@section('content')
    <div class="relative mb-12 mt-8 max-w-2xl mx-auto font-mono flex items-center justify-center">
        <a href="{{ route('funcionarios.home') }}" class="absolute left-0 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl md:text-3xl font-bold text-white font-mono text-center w-full">&lt;CONSULTA DE FUNCIONÁRIOS/&gt;</h1>
    </div>
    <main class="p-8 font-mono">
        <div class="max-w-7xl mx-auto">
            <!-- Filtros -->
            <form method="GET" action="{{ route('funcionarios.index') }}" class="w-full flex flex-col md:flex-row gap-4 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600 items-end">
                <div class="flex-1 flex flex-col">
                    <label for="searchFunction" class="block text-base font-semibold text-blue-200 mb-3">FUNÇÃO</label>
                    <select id="searchFunction" name="searchFunction" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Selecione a função</option>
                        <option value="0">Admin</option>
                        <option value="1">Fotógrafo</option>
                        <option value="2">Videógrafo</option>
                        <option value="3">Piloto de Drone</option>
                        <option value="4">Editor</option>
                        <option value="5">Assistente Técnico</option>
                    </select>
                </div>
                <div class="flex-shrink-0 flex items-end pt-6 md:pt-0">
                    <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200">Filtrar</button>
                </div>
            </form>
            <!-- Resultados -->
            <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 mt-10 shadow-lg">
                <h3 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide">LISTA DE FUNCIONÁRIOS</h3>
                <div class="w-full overflow-x-auto">
                    <table class="w-full min-w-[900px] divide-y divide-slate-600 rounded-lg overflow-hidden">
                        <thead class="bg-slate-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Localização</th>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Telemóvel</th>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Função</th>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Nível</th>
                                <th class="px-6 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Equipamento Próprio</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-600">
                            @forelse($funcionarios as $funcionario)
                                <tr class="hover:bg-slate-800 transition-colors {{ $loop->even ? 'bg-slate-700' : 'bg-slate-600' }}">
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">{{ $funcionario->nome }}</td>
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">{{ $funcionario->morada }}</td>
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">{{ $funcionario->mail ?? $funcionario->email }}</td>
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">{{ $funcionario->telefone }}</td>
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">
                                        @if($funcionario->funcoes && $funcionario->funcoes->count())
                                            {{ $funcionario->funcoes->pluck('funcao')->join(', ') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">{{ $funcionario->nivel ? $funcionario->nivel->nivel : '-' }}</td>
                                    <td class="px-6 py-3 text-white break-words whitespace-normal">{{ $funcionario->tem_equipamento_proprio ? 'Sim' : 'Não' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-400 text-lg">Nenhum funcionário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex justify-center">
                    {{ $funcionarios->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </main>
@endsection
