@if(!$detalhes)
    <div class="text-gray-400 italic">Sem detalhes registados para este evento.</div>
    @return
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-base text-slate-100">
    <div><span class="font-semibold text-slate-400">Nome do Evento:</span> {{ $detalhes->nome_evento ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Empresa:</span> {{ $detalhes->empresa ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Número de participantes:</span> {{ $detalhes->num_participantes ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Fotos:</span> {{ $detalhes->fotos === null ? '—' : ($detalhes->fotos ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Vídeo:</span> {{ $detalhes->video === null ? '—' : ($detalhes->video ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Drone:</span> {{ $detalhes->drone === null ? '—' : ($detalhes->drone ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">SDE:</span> {{ $detalhes->sde === null ? '—' : ($detalhes->sde ? 'Sim' : 'Não') }}</div>
    <div><span class="font-semibold text-slate-400">Hora chegada:</span> {{ $detalhes->hora_chegada_corp ?: '—' }}</div>
    <div><span class="font-semibold text-slate-400">Info extra:</span> {{ $detalhes->info_extra_corp ?: '—' }}</div>
</div>
