@if(!$detalhes)
    <div class="p-4 text-center text-base text-slate-400 bg-slate-800 rounded-xl shadow-inner border border-slate-700 mb-8">
        Sem detalhes registados para este evento.
    </div>
    @return
@endif

<div class="space-y-8">
    {{-- Primeira secção: Informação geral --}}
    <div class="rounded-xl bg-slate-900/85 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Informação Geral</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Fotos:</span> {{ $detalhes->fotos === null ? '—' : ($detalhes->fotos ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Vídeo:</span> {{ $detalhes->video === null ? '—' : ($detalhes->video ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Drone:</span> {{ $detalhes->drone === null ? '—' : ($detalhes->drone ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">SDE:</span> {{ $detalhes->sde === null ? '—' : ($detalhes->sde ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Fotos Convidados:</span> {{ $detalhes->fotos_convidados === null ? '—' : ($detalhes->fotos_convidados ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Nº Convidados:</span> {{ $detalhes->num_convidados_fotos ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Venda de Fotos:</span> {{ $detalhes->venda_fotos === null ? '—' : ($detalhes->venda_fotos ? 'Sim' : 'Não') }}</div>
        </div>
    </div>

    {{-- Criança --}}
    <div class="rounded-xl bg-slate-900/80 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Criança</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Hora Chegada:</span> {{ $detalhes->hora_chegada_casa_crianca ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Hora Saída:</span> {{ $detalhes->hora_saida_casa_crianca ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Nome:</span> {{ $detalhes->nome_crianca ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Morada:</span> {{ $detalhes->morada_crianca ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Agregado Familiar:</span> {{ $detalhes->agregado_crianca ?: '—' }}</div>
            <div class="md:col-span-2"><span class="font-semibold text-slate-400">Informações Extra:</span> {{ $detalhes->info_extra_crianca ?: '—' }}</div>
        </div>
    </div>

    {{-- Igreja --}}
    <div class="rounded-xl bg-slate-900/80 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Igreja</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Morada:</span> {{ $detalhes->morada_igreja ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Instruções:</span> {{ $detalhes->instrucoes_igreja ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Coro:</span> {{ $detalhes->coro === null ? '—' : ($detalhes->coro ? 'Sim' : 'Não') }}</div>
            <div><span class="font-semibold text-slate-400">Localização do coro:</span> {{ $detalhes->coro_localizacao ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Foto Grupo exterior:</span> {{ $detalhes->grupo_exterior === null ? '—' : ($detalhes->grupo_exterior ? 'Sim' : 'Não') }}</div>
            <div class="md:col-span-2"><span class="font-semibold text-slate-400">Informações Extra:</span> {{ $detalhes->info_extra_igreja ?: '—' }}</div>
        </div>
    </div>

    {{-- Quinta --}}
    <div class="rounded-xl bg-slate-900/80 shadow p-6 border border-slate-800">
        <h4 class="text-lg font-semibold mb-4 border-l-4 pl-4 text-white tracking-wide">Quinta</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-slate-100">
            <div><span class="font-semibold text-slate-400">Nome:</span> {{ $detalhes->nome_quinta ?: '—' }}</div>
            <div><span class="font-semibold text-slate-400">Morada:</span> {{ $detalhes->morada_quinta ?: '—' }}</div>
            <div class="md:col-span-2"><span class="font-semibold text-slate-400">Instruções:</span> {{ $detalhes->instrucoes_quinta ?: '—' }}</div>
            <div class="md:col-span-2"><span class="font-semibold text-slate-400">Timeline:</span> {{ $detalhes->timeline ?: '—' }}</div>
        </div>
    </div>
</div>
