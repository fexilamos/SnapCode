@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    @if(session('success'))
        <div style="background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px; border-radius: 6px; margin-bottom: 16px; text-align:center; font-weight:bold;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('success'))
        <script>
            window.onload = function() {
                alert(@json(session('success')));
            }
        </script>
    @endif
    @if(session('success'))
        <div id="toast-success" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: #198754; color: #fff; padding: 16px 32px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); font-weight: bold; z-index: 9999; display: none;">
            {{ session('success') }}
        </div>
        <script>
            window.onload = function() {
                var toast = document.getElementById('toast-success');
                toast.style.display = 'block';
                setTimeout(function() {
                    toast.style.display = 'none';
                }, 3000);
            }
        </script>
    @endif
    <div class="bg-gray-100 rounded-xl shadow p-8 mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Registar Material</h2>
        <form method="POST" action="{{ route('materiais.store') }}">
            @csrf
            <div class="mb-4">
                <label for="cod_categoria" class="block text-gray-700 font-semibold mb-2">Categoria</label>
                <select name="cod_categoria" id="cod_categoria" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione a categoria</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->cod_categoria }}">{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="cod_marca" class="block text-gray-700 font-semibold mb-2">Marca</label>
                <select name="cod_marca" id="cod_marca" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione a marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->cod_marca }}">{{ $marca->marca }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="cod_modelo" class="block text-gray-700 font-semibold mb-2">Modelo</label>
                <select name="cod_modelo" id="cod_modelo" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o modelo</option>
                    @foreach($modelos as $modelo)
                        <option value="{{ $modelo->cod_modelo }}">{{ $modelo->modelo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="num_serie" class="block text-gray-700 font-semibold mb-2">Número de Série</label>
                <input type="text" name="num_serie" id="num_serie" class="form-input w-full rounded border-gray-300 text-black" required>
            </div>
            <div class="mb-4">
                <label for="cod_estado" class="block text-gray-700 font-semibold mb-2">Estado</label>
                <select name="cod_estado" id="cod_estado" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->cod_estado }}">{{ $estado->estado_nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="observacoes" class="block text-gray-700 font-semibold mb-2">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="3" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Registar</button>
            </div>
        </form>
    </div>
</div>
@endsection
