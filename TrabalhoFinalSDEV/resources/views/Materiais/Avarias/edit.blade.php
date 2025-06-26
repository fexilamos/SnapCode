@extends('layouts.dashboard')

@section('content')

<div class="container mx-auto px-4 max-w-lg">
    @if(session('success'))
        <div style="background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px; border-radius: 6px; margin-bottom: 16px; text-align:center; font-weight:bold;">
            {{ session('success') }}
        </div>
        <script>
            window.onload = function() {
                alert(@json(session('success')));
                var toast = document.getElementById('toast-success');
                toast.style.display = 'block';
                setTimeout(function() {
                    toast.style.display = 'none';
                }, 3000);
            }
        </script>
        <div id="toast-success" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: #198754; color: #fff; padding: 16px 32px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); font-weight: bold; z-index: 9999; display: none;">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-100 rounded-xl shadow p-8 mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Avaria</h2>
        <form method="POST" action="{{ route('avarias.update', $avaria->cod_avaria) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Código da Avaria</label>
                <input type="text" value="{{ $avaria->cod_avaria }}" disabled class="form-input w-full rounded border-gray-300 text-black">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Material</label>
                <input type="text" value="{{ $avaria->cod_material }}" disabled class="form-input w-full rounded border-gray-300 text-black">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Data de Registo</label>
                <input type="date" name="data_registo" value="{{ old('data_registo', $avaria->data_registo ? $avaria->data_registo->format('Y-m-d') : '') }}" class="form-input w-full rounded border-gray-300 text-black" required>
            </div>

            <div class="mb-4">
                <label for="cod_servico" class="block text-gray-700 font-semibold mb-2">Serviço (opcional)</label>
                <select name="cod_servico" id="cod_servico" class="form-select w-full rounded border-gray-300 text-black">
                    <option value="">Sem serviço associado</option>
                    @foreach($servicos as $servico)
                        <option value="{{ $servico->cod_servico }}" {{ $avaria->cod_servico == $servico->cod_servico ? 'selected' : '' }}>
                            {{ $servico->nome_servico ?? 'Serviço #' . $servico->cod_servico }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="cod_estado" class="block text-gray-700 font-semibold mb-2">Estado do Material</label>
                <select name="cod_estado" id="cod_estado" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->cod_estado }}" {{ $avaria->material && $avaria->material->cod_estado == $estado->cod_estado ? 'selected' : '' }}>
                            {{ $estado->estado_nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="observacoes" class="block text-gray-700 font-semibold mb-2">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="4" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('observacoes', $avaria->observacoes) }}</textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">
                    Atualizar Avaria
                </button>
            </div>
        </form>
    </div>
</div>


@endsection