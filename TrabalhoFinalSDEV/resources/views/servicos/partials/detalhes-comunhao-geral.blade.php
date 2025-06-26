@if(!$detalhes)
    <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
    @return
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-base text-slate-100">
    <div><span class="font-semibold text-slate-400">Fotos:</span> {{ $detalhes->fotos === null ? '—' : ($detalhes->fotos ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Vídeo:</span> {{ $detalhes->video === null ? '—' : ($detalhes->video ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Drone:</span> {{ $detalhes->drone === null ? '—' : ($detalhes->drone ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">SDE:</span> {{ $detalhes->sde === null ? '—' : ($detalhes->sde ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Formato das fotos:</span> {{ $detalhes->formato_fotos ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Valor da foto:</span> {{ $detalhes->valor_foto ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Formato do vídeo:</span> {{ $detalhes->formato_video ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Valor do vídeo:</span> {{ $detalhes->valor_video ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Hora chegada igreja:</span> {{ $detalhes->hora_chegada_igreja ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Nº de crianças:</span> {{ $detalhes->num_criancas ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Info extra comunhão:</span> {{ $detalhes->info_extra_comunhao ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Coro:</span> {{ $detalhes->coro === null ? '—' : ($detalhes->coro ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Localização do coro:</span> {{ $detalhes->coro_localizacao ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Diplomas:</span> {{ $detalhes->diplomas === null ? '—' : ($detalhes->diplomas ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Grupo exterior:</span> {{ $detalhes->grupo_exterior === null ? '—' : ($detalhes->grupo_exterior ? 'Sim' : 'Não') }}</div>
</div>
