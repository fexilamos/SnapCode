@extends('layouts.dashboard')

@section('content')

<div class="container mx-auto px-4 max-w-lg font-mono">
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

    <div class="bg-slate-700 rounded-xl shadow-xl p-8 mt-8">
        <h2 class="text-2xl font-semibold text-white mb-6 text-center uppercase">Editar Avaria</h2>
        <form method="POST" action="{{ route('avarias.update', $avaria->cod_avaria) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-white font-semibold mb-2 uppercase">Código da Avaria</label>
                <input type="text" value="{{ $avaria->cod_avaria }}" disabled class="form-input w-full rounded border-gray-300 text-black">
            </div>

            <div class="mb-4">
                <label class="block text-white font-semibold mb-2 uppercase">Material</label>
                <input type="text" value="{{ $avaria->cod_material }}" disabled class="form-input w-full rounded border-gray-300 text-black">
            </div>

            <div class="mb-4">
                <label class="block text-white font-semibold mb-2 uppercase">Data de Registo</label>
                <input type="date" name="data_registo" value="{{ old('data_registo', $avaria->data_registo ? $avaria->data_registo->format('Y-m-d') : '') }}" class="form-input w-full rounded border-gray-300 text-black" required>
            </div>

            <div class="mb-4">
                <label for="cod_servico" class="block text-white font-semibold mb-2 uppercase">Serviço (opcional)</label>
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
                <label for="cod_estado" class="block text-white font-semibold mb-2 uppercase">Estado do Material</label>
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
                <label for="observacoes" class="block text-white font-semibold mb-2 uppercase">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="4" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('observacoes', $avaria->observacoes) }}</textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center uppercase">
                    Atualizar Avaria
                </button>
            </div>
        </form>
    </div>
</div>


@endsection
