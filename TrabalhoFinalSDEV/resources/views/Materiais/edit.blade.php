@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 max-w-lg font-mono">
    @if(session('success'))
        <div style="background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px; border-radius: 6px; margin-bottom: 16px; text-align:center; font-weight:bold;" class="font-mono">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-slate-700 rounded-xl shadow-xl p-8 mt-8 font-mono">
        <h2 class="text-2xl font-bold text-white mb-6 text-center font-mono uppercase">EDITAR MATERIAL</h2>
        <form method="POST" action="{{ route('materiais.update', $material->cod_material) }}" class="font-mono">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="cod_categoria" class="block text-white font-semibold mb-2 font-mono uppercase">CATEGORIA</label>
                <select name="cod_categoria" id="cod_categoria" class="form-select w-full rounded border-gray-300 text-black font-mono" required>
                    <option value="">Selecione a categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->cod_categoria }}" {{ $material->cod_categoria == $categoria->cod_categoria ? 'selected' : '' }}>{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="cod_marca" class="block text-white font-semibold mb-2 font-mono uppercase">MARCA</label>
                <select name="cod_marca" id="cod_marca" class="form-select w-full rounded border-gray-300 text-black font-mono" required>
                    <option value="">Selecione a marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->cod_marca }}" {{ $material->cod_marca == $marca->cod_marca ? 'selected' : '' }}>{{ $marca->marca }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="cod_modelo" class="block text-white font-semibold mb-2 font-mono uppercase">MODELO</label>
                <select name="cod_modelo" id="cod_modelo" class="form-select w-full rounded border-gray-300 text-black font-mono" required>
                    <option value="">Selecione o modelo</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->cod_modelo }}" {{ $material->cod_modelo == $modelo->cod_modelo ? 'selected' : '' }}>{{ $modelo->modelo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="num_serie" class="block text-white font-semibold mb-2 font-mono uppercase">NÚMERO DE SÉRIE</label>
                <input type="text" name="num_serie" id="num_serie" class="form-input w-full rounded border-gray-300 text-black font-mono" value="{{ $material->num_serie }}" required>
            </div>
            <div class="mb-4">
                <label for="cod_estado" class="block text-white font-semibold mb-2 font-mono uppercase">ESTADO</label>
                <select name="cod_estado" id="cod_estado" class="form-select w-full rounded border-gray-300 text-black font-mono" required>
                    <option value="">Selecione o estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->cod_estado }}" {{ $material->cod_estado == $estado->cod_estado ? 'selected' : '' }}>{{ $estado->estado_nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="observacoes" class="block text-white font-semibold mb-2 font-mono uppercase">OBSERVAÇÕES</label>
                <textarea name="observacoes" id="observacoes" rows="3" class="form-textarea w-full rounded border-gray-300 text-black font-mono">{{ $material->observacoes }}</textarea>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center font-mono uppercase">EDITAR</button>
            </div>
        </form>
    </div>
</div>
@endsection
