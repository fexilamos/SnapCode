@extends('layouts.dashboard')

@section('content')
    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4">
    <a href="{{ route('materiais.home') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-3xl md:text-4xl font-bold text-white text-center">Consulta de Materiais</h1>
</div>

    <main class="px-4 md:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Filtros -->
<form method="GET" action="{{ route('materiais.index') }}" class="w-full flex flex-col gap-6 mb-12 bg-slate-800 rounded-xl p-8 shadow-lg border border-slate-600">
    <div class="w-full flex flex-col">
        <label for="search" class="block text-base font-semibold text-blue-200 mb-3">Pesquisar</label>
        <input type="text" name="search" id="search" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Pesquisar por nome, marca, modelo..." value="{{ request('search') }}">
    </div>
    <div class="w-full flex flex-col items-center">
        <label class="block text-base font-semibold text-blue-200 mb-3">Categorias</label>
        <div class="flex flex-wrap gap-2 justify-center w-full">
            @php
                $categorias = \App\Models\Categoria::all();
                $categoriasSelecionadas = request('categorias', []);
            @endphp
            @foreach($categorias as $categoria)
                <label class="inline-flex items-center bg-slate-700 rounded px-2 py-1 shadow-xl border border-slate-500">
                    <input type="checkbox" name="categorias[]" value="{{ $categoria->cod_categoria }}" class="form-checkbox text-green-600" {{ in_array($categoria->cod_categoria, (array)$categoriasSelecionadas) ? 'checked' : '' }}>
                    <span class="ml-2 text-white">{{ $categoria->categoria }}</span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="flex flex-col sm:flex-row gap-4 items-center justify-center w-full pt-4">
        <button type="submit" class="px-8 py-3 bg-slate-600 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">Filtrar</button>
        <a href="{{ route('materiais.index') }}" class="px-8 py-3 bg-slate-600 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">Limpar Filtros</a>
    </div>
</form>

            <!-- Resultados -->
            <div class="bg-slate-700 rounded-xl p-8 border border-slate-600 mt-10 shadow-xl">
                <h3 class="text-2xl font-bold text-blue-200 mb-6 tracking-wide text-center">Lista de Materiais</h3>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1000px] divide-y divide-slate-600 rounded-lg overflow-hidden">
                        <thead class="bg-slate-800">
                            <tr>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider"></th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">ID</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Número de Série</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Categoria</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Marca</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Modelo</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Observações</th>
                                <th class="px-4 py-3 text-left text-blue-300 font-semibold uppercase tracking-wider">Opções</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-600">
                            @forelse($materiais as $material)
                                <tr class="hover:bg-slate-800 transition-colors {{ $loop->even ? 'bg-slate-700' : 'bg-slate-600' }}">
                                    <td class="px-4 py-3 text-white text-center align-middle">
                                        @php
                                            $icons = [
                                                'Câmara' => 'camera.png',
                                                'Lente' => 'lente.png',
                                                'Baterias' => 'bateria.png',
                                                'Tripé' => 'tripe.png',
                                                'Iluminação' => 'iluminacao.png',
                                                'Cartões de Memoria' => 'cartaomemoria.png',
                                                'Microfone' => 'microfone.png',
                                                'Drone' => 'drone.png'
                                            ];
                                            $categoriaNome = $material->categoria->categoria ?? '';
                                            $icon = $icons[$categoriaNome] ?? 'LOGO.png';
                                        @endphp
                                        <img src="{{ asset('images/icons/' . $icon) }}" alt="{{ $categoriaNome }}" width="42">
                                    </td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->cod_material }}</td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->num_serie }}</td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->categoria->categoria ?? '-' }}</td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->marca->marca ?? '-' }}</td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->modelo->modelo ?? '-' }}</td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->estado->estado_nome ?? '-' }}</td>
                                    <td class="px-4 py-3 text-white text-center align-middle">{{ $material->observacoes }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col md:flex-row gap-2 justify-center items-center">
                                            <a href="{{ route('materiais.edit', $material->cod_material) }}" class="bg-slate-800 text-white px-3 py-1 rounded hover:bg-slate-700 text-xs">Editar</a>
                                            <form action="{{ route('materiais.destroy', $material->cod_material) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-slate-800 text-white px-3 py-1 rounded hover:bg-slate-700 text-xs" onclick="return confirm('Tem certeza que deseja eliminar este material?')">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-8 text-center text-slate-400 text-lg">Nenhum material encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-10 pt-6 border-t border-slate-600 flex justify-center">
                    {{ $materiais->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </main>
@endsection
