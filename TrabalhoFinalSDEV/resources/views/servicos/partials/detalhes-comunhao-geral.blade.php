@if(!$detalhes)
    <div class="p-4 text-center text-base text-slate-400 bg-slate-800 rounded-xl shadow-inner border border-slate-700 mb-8 font-mono">
        Sem detalhes registados para este evento.
    </div>
    @return
@endif

<div class="space-y-8 font-mono">
    {{-- Informação geral --}}
    <div class="rounded-xl bg-slate-900/85 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Informação Geral</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Fotos:</span> {{ $detalhes->fotos === null ? '—' : ($detalhes->fotos ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Vídeo:</span> {{ $detalhes->video === null ? '—' : ($detalhes->video ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Drone:</span> {{ $detalhes->drone === null ? '—' : ($detalhes->drone ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">SDE:</span> {{ $detalhes->sde === null ? '—' : ($detalhes->sde ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Formato das Fotos:</span> {{ $detalhes->formato_fotos ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Valor da Foto:</span> {{ $detalhes->valor_foto ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Formato do Vídeo:</span> {{ $detalhes->formato_video ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Valor do Vídeo:</span> {{ $detalhes->valor_video ?: '—' }}</div>
        </div>
    </div>

    {{-- Igreja --}}
    <div class="rounded-xl bg-slate-900/80 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Igreja</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Hora Chegada:</span> {{ $detalhes->hora_chegada_igreja ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Nº de Crianças:</span> {{ $detalhes->num_criancas ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Informações Extra:</span> {{ $detalhes->info_extra_comunhao ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Coro:</span> {{ $detalhes->coro === null ? '—' : ($detalhes->coro ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Localização do coro:</span> {{ $detalhes->coro_localizacao ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Diplomas:</span> {{ $detalhes->diplomas === null ? '—' : ($detalhes->diplomas ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Foto Grupo Exterior:</span> {{ $detalhes->grupo_exterior === null ? '—' : ($detalhes->grupo_exterior ? 'Sim' : 'Não') }}</div>
        </div>
    </div>
</div>
