@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl text-white font-bold mb-6">Consultar Materiais</h2>
    <div class="bg-gray-100 rounded-xl shadow p-6 mb-8">
        <form method="GET" action="{{ route('materiais.index') }}" class="mb-4">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text" name="search" class="form-input flex-1 rounded border-gray-300 text-black" placeholder="Pesquisar por nome, marca, modelo..." value="{{ request('search') }}">
            </div>
            <div class="flex flex-wrap gap-2 mt-4">
                @php
                    $categorias = \App\Models\Categoria::all();
                    $categoriasSelecionadas = request('categorias', []);
                @endphp
                @foreach($categorias as $categoria)
                    <label class="inline-flex items-center bg-white rounded px-2 py-1 shadow border border-gray-300">
                        <input type="checkbox" name="categorias[]" value="{{ $categoria->cod_categoria }}" class="form-checkbox text-green-600" {{ in_array($categoria->cod_categoria, (array)$categoriasSelecionadas) ? 'checked' : '' }}>
                        <span class="ml-2 text-black">{{ $categoria->categoria }}</span>
                    </label>
                @endforeach
            </div>
            <div class="mt-4">
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" type="submit">Pesquisar</button>
            </div>
        </form>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow mt-4">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-black text-center align-middle"></th>
                        <th class="py-2 px-4 text-black text-center align-middle">ID</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Número de Série</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Categoria</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Marca</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Modelo</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Estado</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Observações</th>
                        <th class="py-2 px-4 text-black text-center align-middle">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materiais as $material)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4 text-black text-center align-middle">
                                @php
                                    $icons = [
                                        'Câmara' => 'camera.png',
                                        'Lente' => 'lente.png',
                                        'Baterias' => 'bateria.png',
                                        'Tripé' => 'tripe.png',
                                        'Iluminação' => 'iluminacao.png',
                                        'Cartões de Memoria' => 'cartaomemoria.png',
                                        'Microfone' => 'microfone.png',
                                        'Drone' => 'drone.png',
                                        'Mochilas' => 'mochila.png',
                                    ];
                                    $categoriaNome = $material->categoria->categoria ?? '';
                                    $icon = $icons[$categoriaNome] ?? 'LOGO.png';
                                @endphp
                                <img src="{{ asset('images/icons/' . $icon) }}" alt="{{ $categoriaNome }}" width="42">
                            </td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->cod_material }}</td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->num_serie }}</td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->categoria->categoria ?? '-' }}</td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->marca->marca ?? '-' }}</td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->modelo->modelo ?? '-' }}</td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->estado->estado_nome ?? '-' }}</td>
                            <td class="py-2 px-4 text-black text-center align-middle">{{ $material->observacoes }}</td>
                            <td class="py-2 px-4 flex flex-col gap-1 md:flex-row md:gap-2 justify-center items-center align-middle min-h-[48px]">
                                <a href="{{ route('materiais.edit', $material->cod_material) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Editar</a>
                                <form action="{{ route('materiais.destroy', $material->cod_material) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-xs" onclick="return confirm('Tem certeza que deseja eliminar este material?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-gray-500">Nenhum material encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
