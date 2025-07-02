@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center py-12 font-mono">
    <h1 class="text-4xl font-mono text-white mb-8 drop-shadow-xl tracking-tight">&lt;CHECK-IN/&gt;</h1>
    <div class="w-full max-w-5xl">

        {{-- EVENTO EM DESTAQUE --}}
        <div class="mx-auto mb-10">
            <div class="bg-slate-900/90 rounded-xl border border-slate-700 text-white py-8 px-6 text-center shadow-lg">
                <h2 class="text-3xl font-extrabold mb-2 drop-shadow-xl">{{ $servico->nome_servico }}</h2>
                <div class="text-xl mb-2">
                    <span class="font-bold">Data:</span>
                    {{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}
                </div>
            </div>
        </div>

        {{-- FUNCIONÁRIOS --}}
        <h2 class="text-2xl font-bold mb-4 text-slate-100 mt-4 text-center">Funcionários no Evento</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 justify-items-center">
            @foreach($funcionarios as $funcionario)
            <div class="flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 w-full max-w-xl mx-auto relative group">
                <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <div class="flex-1 w-full flex flex-col md:flex-row md:items-center md:justify-between">
                    <span class="font-bold text-white">{{ $funcionario->nome }}</span>
                    @if($funcionario->pivot && $funcionario->pivot->funcao_no_servico)
                        @php
                            $funcao = \App\Models\Funcao::find($funcionario->pivot->funcao_no_servico);
                        @endphp
                        @if($funcao)
                        <span class="ml-2 mt-2 md:mt-0 px-2 py-1 rounded bg-slate-800 text-xs text-slate-200">
                            {{ $funcao->funcao }}
                        </span>
                        @endif
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- FORM CHECK-IN --}}
        <form method="POST" action="{{ route('servicos.checkin.update', $servico->cod_servico) }}">
            @csrf
            @method('PUT')

            {{-- KITS POR DEVOLVER --}}
            <h2 class="text-2xl font-bold mb-4 text-slate-100 mt-10 text-center">Kits por Devolver</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 justify-items-center">
                @forelse($kitsNaoDevolvidos as $kit)
                <div class="flex flex-col bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 w-full max-w-xl mx-auto relative group items-center">
                    <div class="w-full">
                        <div class="flex items-center justify-center mb-2">
                            <span class="text-lg font-bold text-white text-center w-full">{{ $kit->nome_kit }}</span>
                        </div>
                        <ul class="text-slate-200 text-sm pl-3 mb-4 list-disc text-center">
                            @foreach($kit->materiais as $material)
                            <li class="text-center list-none">
                                {{ $material->marca->marca ?? 'Marca desconhecida' }}
                                &mdash;
                                {{ $material->modelo->modelo ?? 'Modelo desconhecido' }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <button
                        type="button"
                        class="btn-entregue w-full px-6 py-2 mt-2 bg-sky-800 hover:bg-sky-700 text-white rounded-lg font-semibold transition"
                        data-kit="{{ $kit->cod_kit }}">Entregue</button>
                    <input type="hidden" name="kits_devolvidos[]" value="{{ $kit->cod_kit }}" disabled>
                </div>
                @empty
                <div class="col-span-2 text-green-400 font-bold text-center">
                    Todos os kits já foram devolvidos.
                </div>
                @endforelse
            </div>
            {{-- AVARIAS/PERDAS --}}
            <div class="flex flex-col md:flex-row gap-4 mb-10 justify-center items-center">
                <a href="{{ route('avarias.create', $servico->cod_servico) }}"
                    class="bg-orange-600 text-white px-6 py-3 rounded-lg shadow hover:bg-orange-700 font-semibold transition text-center">
                    Registar Avaria
                </a>
                <a href="{{ route('perdas.create', $servico->cod_servico) }}"
                    class="bg-red-600 text-white px-6 py-3 rounded-lg shadow hover:bg-red-700 font-semibold transition text-center">
                    Registar Perda
                </a>
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
    document.addEventListener('DOMContentLoaded', function() {
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
