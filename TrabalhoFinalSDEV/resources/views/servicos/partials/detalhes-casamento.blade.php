@if(!$detalhes)
    <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
    @return
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-base text-slate-100">
    <div><span class="font-semibold text-slate-400">Fotos:</span> {{ $detalhes->fotos === null ? '—' : ($detalhes->fotos ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Vídeo:</span> {{ $detalhes->video === null ? '—' : ($detalhes->video ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Drone:</span> {{ $detalhes->drone === null ? '—' : ($detalhes->drone ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">SDE:</span> {{ $detalhes->sde === null ? '—' : ($detalhes->sde ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Fotos convidados:</span> {{ $detalhes->fotos_convidados === null ? '—' : ($detalhes->fotos_convidados ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Nº convidados para fotos:</span> {{ $detalhes->num_convidados_fotos ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Venda de fotos:</span> {{ $detalhes->venda_fotos === null ? '—' : ($detalhes->venda_fotos ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Hora chegada casa noivo:</span> {{ $detalhes->hora_chegada_casa_noivo ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Hora saída casa noivo:</span> {{ $detalhes->hora_saida_casa_noivo ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Nome do noivo:</span> {{ $detalhes->nome_noivo ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada do noivo:</span> {{ $detalhes->morada_noivo ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Agregado do noivo:</span> {{ $detalhes->agregado_noivo ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Info extra noivo:</span> {{ $detalhes->info_extra_noivo ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Hora chegada casa noiva:</span> {{ $detalhes->hora_chegada_casa_noiva ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Nome da noiva:</span> {{ $detalhes->nome_noiva ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada da noiva:</span> {{ $detalhes->morada_noiva ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Agregado da noiva:</span> {{ $detalhes->agregado_noiva ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Info extra noiva:</span> {{ $detalhes->info_extra_noiva ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada da igreja:</span> {{ $detalhes->morada_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Instruções igreja:</span> {{ $detalhes->instrucoes_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Ordem de entrada:</span> {{ $detalhes->ordem_entrada ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Coro:</span> {{ $detalhes->coro === null ? '—' : ($detalhes->coro ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Localização do coro:</span> {{ $detalhes->coro_localizacao ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Ordem das leituras:</span> {{ $detalhes->ordem_leituras ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Oferta ramo:</span> {{ $detalhes->oferta_ramo === null ? '—' : ($detalhes->oferta_ramo ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Grupo exterior:</span> {{ $detalhes->grupo_exterior === null ? '—' : ($detalhes->grupo_exterior ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Instruções saída igreja:</span> {{ $detalhes->instrucoes_saida_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Info extra igreja:</span> {{ $detalhes->info_extra_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Nome da quinta:</span> {{ $detalhes->nome_quinta ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada da quinta:</span> {{ $detalhes->morada_quinta ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Instruções quinta:</span> {{ $detalhes->instrucoes_quinta ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Timeline:</span> {{ $detalhes->timeline ?: '—' }}</div>
</div>
