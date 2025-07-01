@if(!$detalhes)
    <div class="p-4 text-center text-base text-slate-400 bg-slate-800 rounded-xl shadow-inner border border-slate-700 mb-8 font-mono">
        Sem detalhes registados para este evento.
    </div>
    @return
@endif



    {{-- Serviço --}}
    <div class="rounded-xl bg-slate-900/80 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Serviço</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Fotos:</span> {{ $detalhes->fotos === null ? '—' : ($detalhes->fotos ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Vídeo:</span> {{ $detalhes->video === null ? '—' : ($detalhes->video ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Drone:</span> {{ $detalhes->drone === null ? '—' : ($detalhes->drone ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">SDE:</span> {{ $detalhes->sde === null ? '—' : ($detalhes->sde ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Hora Chegada:</span> {{ $detalhes->hora_chegada_corp ?: '—' }}</div>
            <div class="md:col-span-2"><span class="font-semibold text-slate-400">Informações extra:</span> {{ $detalhes->info_extra_corp ?: '—' }}</div>
        </div>
    </div>
</div>
