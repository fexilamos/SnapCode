@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center py-12 font-mono">

    {{-- EVENTO EM DESTAQUE --}}
    <div class="w-full max-w-2xl mx-auto mb-10">
        <div class="bg-slate-900/90 rounded-xl border border-slate-700 text-white py-8 px-6 text-center shadow-lg">
            <h1 class="text-5xl font-extrabold mb-2 drop-shadow-xl">{{ $servico->nome_servico }}</h1>
            <div class="text-xl mb-2">
                <span class="font-bold">Data:</span>
                {{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}
            </div>
        </div>
    </div>

    <div class="w-full max-w-4xl">

        {{-- FUNCIONÁRIOS --}}
        <h2 class="text-2xl font-bold mb-4 text-slate-100 mt-4">Funcionários no Evento</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            @foreach($funcionarios as $funcionario)
                <div class="bg-slate-900 p-4 rounded-xl border border-slate-700">
                    <strong>{{ $funcionario->nome }}</strong>
                    @if($funcionario->pivot && $funcionario->pivot->funcao_no_servico)
                        <span class="ml-2 px-2 py-1 rounded bg-slate-800 text-xs text-slate-200">
                            {{ $funcionario->pivot->funcao_no_servico }}
                        </span>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- FORM CHECK-IN --}}
        <form method="POST" action="{{ route('servicos.checkin.update', $servico->cod_servico) }}">
            @csrf
            @method('PUT')

            {{-- KITS POR DEVOLVER --}}
            <h2 class="text-2xl font-bold mb-4 text-slate-100 mt-10">Kits por Devolver</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                @forelse($kitsNaoDevolvidos as $kit)
                    <div class="bg-slate-900 p-6 rounded-xl border border-slate-700 shadow-md flex flex-col justify-between">
                        <div>
                            <span class="text-lg font-bold text-white">{{ $kit->nome_kit }}</span>
                            <ul class="text-slate-200 text-sm pl-3 mb-4 list-disc">
                                @foreach($kit->materiais as $material)
                                    <li>
                                        {{ $material->nome_material ?? $material->cod_material }}
                                        <span class="ml-2 text-xs text-slate-400">x{{ $material->pivot->quantidade }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <button
                            type="button"
                            class="btn-entregue w-full px-6 py-2 mt-2 bg-sky-800 hover:bg-sky-700 text-white rounded-lg font-semibold transition"
                            data-kit="{{ $kit->cod_kit }}"
                        >Entregue</button>
                        <input type="hidden" name="kits_devolvidos[]" value="{{ $kit->cod_kit }}" disabled>
                    </div>
                @empty
                    <div class="col-span-2 text-green-400 font-bold text-center">
                        Todos os kits já foram devolvidos.
                    </div>
                @endforelse
            </div>

            {{-- BOTÃO GUARDAR --}}
            <div class="flex justify-end mt-8">
                <button type="submit"
                    class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2 shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Guardar</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- JS PARA BOTÃO "ENTREGUE" VISUAL --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-entregue').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let parent = btn.parentElement;
            let check = document.createElement('div');
            check.className = 'flex justify-center items-center mt-2';
            check.innerHTML = `<svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg><span class="ml-2 text-green-400 font-bold">Entregue</span>`;
            parent.replaceChild(check, btn);

            // Ativa o input hidden para enviar no submit
            let input = parent.querySelector('input[type=hidden][name="kits_devolvidos[]"]');
            input.disabled = false;
        });
    });
});
</script>
@endsection
