@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    @if(session('success'))
        <div style="background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px; border-radius: 6px; margin-bottom: 16px; text-align:center; font-weight:bold;">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-gray-100 rounded-xl shadow p-8 mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Material</h2>
        <form method="POST" action="{{ route('materiais.update', $material->cod_material) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="cod_categoria" class="block text-gray-700 font-semibold mb-2">Categoria</label>
                <select name="cod_categoria" id="cod_categoria" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione a categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->cod_categoria }}" {{ $material->cod_categoria == $categoria->cod_categoria ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="cod_marca" class="block text-gray-700 font-semibold mb-2">Marca</label>
                <select name="cod_marca" id="cod_marca" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione a marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->cod_marca }}" {{ $material->cod_marca == $marca->cod_marca ? 'selected' : '' }}>{{ $marca->marca }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="cod_modelo" class="block text-gray-700 font-semibold mb-2">Modelo</label>
                <select name="cod_modelo" id="cod_modelo" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o modelo</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->cod_modelo }}" {{ $material->cod_modelo == $modelo->cod_modelo ? 'selected' : '' }}>{{ $modelo->modelo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="num_serie" class="block text-gray-700 font-semibold mb-2">Número de Série</label>
                <input type="text" name="num_serie" id="num_serie" class="form-input w-full rounded border-gray-300 text-black" value="{{ $material->num_serie }}" required>
            </div>
            <div class="mb-4">
                <label for="cod_estado" class="block text-gray-700 font-semibold mb-2">Estado</label>
                <select name="cod_estado" id="cod_estado" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->cod_estado }}" {{ $material->cod_estado == $estado->cod_estado ? 'selected' : '' }}>{{ $estado->estado_nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="observacoes" class="block text-gray-700 font-semibold mb-2">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="3" class="form-textarea w-full rounded border-gray-300 text-black">{{ $material->observacoes }}</textarea>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Editar</button>
            </div>
        </form>
    </div>
</div>
@endsection
