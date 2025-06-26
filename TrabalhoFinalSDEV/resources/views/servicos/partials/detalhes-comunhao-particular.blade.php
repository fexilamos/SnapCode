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
    <div><span class="font-semibold text-slate-400">Hora chegada casa criança:</span> {{ $detalhes->hora_chegada_casa_crianca ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Hora saída casa criança:</span> {{ $detalhes->hora_saida_casa_crianca ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Nome da criança:</span> {{ $detalhes->nome_crianca ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada da criança:</span> {{ $detalhes->morada_crianca ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Agregado da criança:</span> {{ $detalhes->agregado_crianca ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Info extra criança:</span> {{ $detalhes->info_extra_crianca ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada da igreja:</span> {{ $detalhes->morada_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Instruções igreja:</span> {{ $detalhes->instrucoes_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Coro:</span> {{ $detalhes->coro === null ? '—' : ($detalhes->coro ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Localização do coro:</span> {{ $detalhes->coro_localizacao ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Grupo exterior:</span> {{ $detalhes->grupo_exterior === null ? '—' : ($detalhes->grupo_exterior ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Info extra igreja:</span> {{ $detalhes->info_extra_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Nome da quinta:</span> {{ $detalhes->nome_quinta ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Morada da quinta:</span> {{ $detalhes->morada_quinta ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Instruções quinta:</span> {{ $detalhes->instrucoes_quinta ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Timeline:</span> {{ $detalhes->timeline ?: '—' }}</div>
</div>
