@extends('layouts.dashboard')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center py-10 font-mono">
        <div class="w-full max-w-2xl mx-auto bg-slate-900/90 rounded-xl border border-slate-700 shadow-lg p-8">
            <h2 class="text-3xl font-bold text-white mb-6 text-center">Relatório Pós-Evento</h2>
            <!-- Dados do Evento -->
            <div class="mb-4">
                <span class="block text-lg font-semibold text-blue-300">Evento:</span>
                <span class="text-white">{{ $relatorio->servico->nome_servico }} -
                    {{ \Carbon\Carbon::parse($relatorio->servico->data_inicio)->format('d/m/Y') }}</span>
            </div>
            <div class="mb-4">
                <span class="block text-lg font-semibold text-blue-300">Funcionários:</span>
                <span class="text-white">
                    @foreach ($relatorio->servico->funcionarios as $f)
                        {{ $f->nome }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </span>
            </div>
            <div class="mb-8">
                <span class="block text-lg font-semibold text-blue-300">Kits:</span>
                <span class="text-white">
                    @foreach ($relatorio->servico->kits as $k)
                        {{ $k->nome_kit }}{{ !$loop->last ? ',' : '' }}
                    @endforeach
                </span>
            </div>

            <!-- Resultados -->
            <div class="mb-6">
                <label class="block text-white font-bold mb-2">Houve atraso?</label>
                <span class="text-white">
                    {{ $relatorio->houve_atraso ? 'Sim' : 'Não' }}
                </span>
                @if ($relatorio->houve_atraso && $relatorio->motivo_atraso)
                    <div class="mt-2 pl-4">
                        <span class="block text-blue-200 mb-1">Motivo do atraso:</span>
                        <span class="text-white">{{ $relatorio->motivo_atraso }}</span>
                    </div>
                @endif
            </div>
            <div class="mb-6">
                <label class="block text-white font-bold mb-2">Houve incidentes?</label>
                <span class="text-white">
                    {{ $relatorio->houve_incidentes ? 'Sim' : 'Não' }}
                </span>
                @if ($relatorio->houve_incidentes && $relatorio->descricao_incidente)
                    <div class="mt-2 pl-4">
                        <span class="block text-blue-200 mb-1">Descrição do incidente:</span>
                        <span class="text-white">{{ $relatorio->descricao_incidente }}</span>
                    </div>
                @endif
            </div>
            <div class="mb-8">
                <label class="block text-white font-bold mb-2">Highlights (foto e vídeo) já foram selecionados?</label>
                <span class="text-white">
                    {{ $relatorio->highlights_selecionados ? 'Sim' : 'Não' }}
                </span>
            </div>

            <div class="mb-6">
                <h3 class="text-xl text-blue-400 font-bold mb-2">Condições Quinta</h3>
                @foreach (['espaco' => 'Espaço de trabalho', 'iluminacao' => 'Iluminação', 'estacionamento' => 'Estacionamento', 'staff' => 'Staff'] as $campo => $label)
                    <div class="mb-2">
                        <span class="block text-blue-200 mb-1">{{ $label }}:</span>
                        <span class="text-white">
                            @php $val = $relatorio->{'quinta_' . $campo}; @endphp
                            {{ $val === null ? 'Não aplica' : $val . '/5' }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="mb-6">
                <h3 class="text-xl text-blue-400 font-bold mb-2">Condições Igreja</h3>
                @foreach (['espaco' => 'Espaço de trabalho', 'iluminacao' => 'Iluminação', 'estacionamento' => 'Estacionamento'] as $campo => $label)
                    <div class="mb-2">
                        <span class="block text-blue-200 mb-1">{{ $label }}:</span>
                        <span class="text-white">
                            @php $val = $relatorio->{'igreja_' . $campo}; @endphp
                            {{ $val === null ? 'Não aplica' : $val . '/5' }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="mb-6">
                <label class="block text-blue-200 mb-2 font-bold">Observações finais</label>
                <span class="text-white">
                    {{ $relatorio->observacoes ?: '—' }}
                </span>
            </div>
        </div>
    </div>
@endsection
