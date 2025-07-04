@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center py-10 font-mono">
    <div class="w-full max-w-2xl mx-auto bg-slate-900/90 rounded-xl border border-slate-700 shadow-lg p-8">
        <h2 class="text-3xl font-bold text-white mb-6 text-center">Relatório Pós-Evento</h2>
        <!-- Dados do Evento -->
        <div class="mb-4">
            <span class="block text-lg font-semibold text-blue-300">Evento:</span>
            <span class="text-white">{{ $servico->nome_servico }} - {{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</span>
        </div>
        <div class="mb-4">
            <span class="block text-lg font-semibold text-blue-300">Funcionários:</span>
            <span class="text-white">
                @foreach($servico->funcionarios as $f)
                    {{ $f->nome }}{{ !$loop->last ? ',' : '' }}
                @endforeach
            </span>
        </div>
        <div class="mb-8">
            <span class="block text-lg font-semibold text-blue-300">Kits:</span>
            <span class="text-white">
                @foreach($servico->kits as $k)
                    {{ $k->nome_kit }}{{ !$loop->last ? ',' : '' }}
                @endforeach
            </span>
        </div>

        <!-- Formulário -->
        <form method="POST" action="{{ route('servicos.relatorios.store') }}">
            @csrf
            <input type="hidden" name="cod_servico" value="{{ $servico->cod_servico }}">

            {{-- Houve atraso --}}
            <div class="mb-6">
                <label class="block text-white font-bold mb-2">Houve atraso?</label>
                <div class="flex gap-4 items-center">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="houve_atraso" value="1" onclick="mostrarMotivoAtraso(true)">
                        <span class="text-white">Sim</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="houve_atraso" value="0" onclick="mostrarMotivoAtraso(false)">
                        <span class="text-white">Não</span>
                    </label>
                </div>
                <div id="motivoAtrasoBox" class="mt-3 hidden">
                    <label class="block text-blue-200 mb-1">Motivo do atraso</label>
                    <textarea name="motivo_atraso" rows="2" class="w-full rounded bg-slate-800 border border-slate-700 text-white p-2"></textarea>
                </div>
            </div>

            {{-- Houve incidentes --}}
            <div class="mb-6">
                <label class="block text-white font-bold mb-2">Houve incidentes?</label>
                <div class="flex gap-4 items-center">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="houve_incidentes" value="1" onclick="mostrarIncidente(true)">
                        <span class="text-white">Sim</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="houve_incidentes" value="0" onclick="mostrarIncidente(false)">
                        <span class="text-white">Não</span>
                    </label>
                </div>
                <div id="descricaoIncidenteBox" class="mt-3 hidden">
                    <label class="block text-blue-200 mb-1">Descreve o incidente</label>
                    <textarea name="descricao_incidente" rows="2" class="w-full rounded bg-slate-800 border border-slate-700 text-white p-2"></textarea>
                </div>
            </div>

            {{-- Highlights --}}
            <div class="mb-8">
                <label class="block text-white font-bold mb-2">Highlights (foto e vídeo) já foram selecionados?</label>
                <div class="flex gap-4 items-center">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="highlights_selecionados" value="1">
                        <span class="text-white">Sim</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="highlights_selecionados" value="0">
                        <span class="text-white">Não</span>
                    </label>
                </div>
            </div>

            {{-- Condições Quinta --}}
            <div class="mb-6">
                <h3 class="text-xl text-blue-400 font-bold mb-2">Condições Quinta</h3>
                @foreach(['espaco' => 'Espaço de trabalho', 'iluminacao' => 'Iluminação', 'estacionamento' => 'Estacionamento', 'staff' => 'Staff'] as $campo => $label)
                    <div class="mb-3">
                        <label class="block text-blue-200 mb-1">{{ $label }}</label>
                        <div class="flex gap-2 items-center">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="quinta_{{ $campo }}" value="" checked>
                                <span class="text-white">N/A</span>
                            </label>
                            @for($i = 1; $i <= 5; $i++)
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="quinta_{{ $campo }}" value="{{ $i }}">
                                    <span class="text-white">{{ $i }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Condições Igreja --}}
            <div class="mb-6">
                <h3 class="text-xl text-blue-400 font-bold mb-2">Condições Igreja</h3>
                @foreach(['espaco' => 'Espaço de trabalho', 'iluminacao' => 'Iluminação', 'estacionamento' => 'Estacionamento'] as $campo => $label)
                    <div class="mb-3">
                        <label class="block text-blue-200 mb-1">{{ $label }}</label>
                        <div class="flex gap-2 items-center">
                            <label class="flex items-center gap-1">
                                <input type="radio" name="igreja_{{ $campo }}" value="" checked>
                                <span class="text-white">N/A</span>
                            </label>
                            @for($i = 1; $i <= 5; $i++)
                                <label class="flex items-center gap-1">
                                    <input type="radio" name="igreja_{{ $campo }}" value="{{ $i }}">
                                    <span class="text-white">{{ $i }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Observações --}}
            <div class="mb-6">
                <label class="block text-blue-200 mb-2 font-bold">Observações finais</label>
                <textarea name="observacoes" rows="3" class="w-full rounded bg-slate-800 border border-slate-700 text-white p-2"></textarea>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit"
                    class="px-8 py-3 bg-sky-800 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2 shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Guardar Relatório</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function mostrarMotivoAtraso(mostrar) {
        document.getElementById('motivoAtrasoBox').classList.toggle('hidden', !mostrar);
    }
    function mostrarIncidente(mostrar) {
        document.getElementById('descricaoIncidenteBox').classList.toggle('hidden', !mostrar);
    }
</script>
@endsection
