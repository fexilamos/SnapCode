<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Primeira secção: opções de serviço -->
    <div>
        <label for="detalhes_fotos_casamento" class="block font-semibold mb-1 text-white">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_casamento" name="detalhes[fotos]" value="1"
            @if(old('detalhes.fotos', $servico->detalhesCasamento->fotos ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_video_casamento" class="block font-semibold mb-1 text-white">Vídeo</label>
        <input type="checkbox" id="detalhes_video_casamento" name="detalhes[video]" value="1"
            @if(old('detalhes.video', $servico->detalhesCasamento->video ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_drone_casamento" class="block font-semibold mb-1 text-white">Drone</label>
        <input type="checkbox" id="detalhes_drone_casamento" name="detalhes[drone]" value="1"
            @if(old('detalhes.drone', $servico->detalhesCasamento->drone ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_sde_casamento" class="block font-semibold mb-1 text-white">SDE</label>
        <input type="checkbox" id="detalhes_sde_casamento" name="detalhes[sde]" value="1"
            @if(old('detalhes.sde', $servico->detalhesCasamento->sde ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_fotos_convidados" class="block font-semibold mb-1 text-white">Fotos Convidados</label>
        <input type="checkbox" id="detalhes_fotos_convidados" name="detalhes[fotos_convidados]" value="1"
            @if(old('detalhes.fotos_convidados', $servico->detalhesCasamento->fotos_convidados ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_num_convidados_fotos" class="block font-semibold mb-1 text-white">Nº Convidados</label>
        <input type="number" id="detalhes_num_convidados_fotos" name="detalhes[num_convidados_fotos]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.num_convidados_fotos', $servico->detalhesCasamento->num_convidados_fotos ?? '') }}">
    </div>
    <div>
        <label for="detalhes_venda_fotos" class="block font-semibold mb-1 text-white">Venda Fotos</label>
        <input type="checkbox" id="detalhes_venda_fotos" name="detalhes[venda_fotos]" value="1"
            @if(old('detalhes.venda_fotos', $servico->detalhesCasamento->venda_fotos ?? false)) checked @endif>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Noivo</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_hora_chegada_casa_noivo" class="block font-semibold mb-1 text-white">Hora Chegada</label>
        <input type="time" id="detalhes_hora_chegada_casa_noivo" name="detalhes[hora_chegada_casa_noivo]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_chegada_casa_noivo', $servico->detalhesCasamento->hora_chegada_casa_noivo ?? '') }}">
    </div>
    <div>
        <label for="detalhes_hora_saida_casa_noivo" class="block font-semibold mb-1 text-white">Hora Saída</label>
        <input type="time" id="detalhes_hora_saida_casa_noivo" name="detalhes[hora_saida_casa_noivo]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_saida_casa_noivo', $servico->detalhesCasamento->hora_saida_casa_noivo ?? '') }}">
    </div>
    <div>
        <label for="detalhes_nome_noivo" class="block font-semibold mb-1 text-white">Nome</label>
        <input type="text" id="detalhes_nome_noivo" name="detalhes[nome_noivo]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_noivo', $servico->detalhesCasamento->nome_noivo ?? '') }}">
    </div>
    <div>
        <label for="detalhes_morada_noivo" class="block font-semibold mb-1 text-white">Morada</label>
        <input type="text" id="detalhes_morada_noivo" name="detalhes[morada_noivo]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_noivo', $servico->detalhesCasamento->morada_noivo ?? '') }}">
    </div>
    <div>
        <label for="detalhes_agregado_noivo" class="block font-semibold mb-1 text-white">Agregado Familiar</label>
        <input type="text" id="detalhes_agregado_noivo" name="detalhes[agregado_noivo]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.agregado_noivo', $servico->detalhesCasamento->agregado_noivo ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_noivo" class="block font-semibold mb-1 text-white">Informações Extra</label>
        <textarea id="detalhes_info_extra_noivo" name="detalhes[info_extra_noivo]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_noivo', $servico->detalhesCasamento->info_extra_noivo ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Noiva</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_hora_chegada_casa_noiva" class="block font-semibold mb-1 text-white">Hora Chegada</label>
        <input type="time" id="detalhes_hora_chegada_casa_noiva" name="detalhes[hora_chegada_casa_noiva]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_chegada_casa_noiva', $servico->detalhesCasamento->hora_chegada_casa_noiva ?? '') }}">
    </div>
    <div>
        <label for="detalhes_nome_noiva" class="block font-semibold mb-1 text-white">Nome</label>
        <input type="text" id="detalhes_nome_noiva" name="detalhes[nome_noiva]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_noiva', $servico->detalhesCasamento->nome_noiva ?? '') }}">
    </div>
    <div>
        <label for="detalhes_morada_noiva" class="block font-semibold mb-1 text-white">Morada</label>
        <input type="text" id="detalhes_morada_noiva" name="detalhes[morada_noiva]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_noiva', $servico->detalhesCasamento->morada_noiva ?? '') }}">
    </div>
    <div>
        <label for="detalhes_agregado_noiva" class="block font-semibold mb-1 text-white">Agregado Familiar</label>
        <input type="text" id="detalhes_agregado_noiva" name="detalhes[agregado_noiva]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.agregado_noiva', $servico->detalhesCasamento->agregado_noiva ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_noiva" class="block font-semibold mb-1 text-white">Informações Extra</label>
        <textarea id="detalhes_info_extra_noiva" name="detalhes[info_extra_noiva]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_noiva', $servico->detalhesCasamento->info_extra_noiva ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Igreja</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_morada_igreja" class="block font-semibold mb-1 text-white">Morada</label>
        <input type="text" id="detalhes_morada_igreja" name="detalhes[morada_igreja]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_igreja', $servico->detalhesCasamento->morada_igreja ?? '') }}">
    </div>
    <div>
        <label for="detalhes_instrucoes_igreja" class="block font-semibold mb-1 text-white">Instruções</label>
        <textarea id="detalhes_instrucoes_igreja" name="detalhes[instrucoes_igreja]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.instrucoes_igreja', $servico->detalhesCasamento->instrucoes_igreja ?? '') }}</textarea>
    </div>
    <div>
        <label for="detalhes_ordem_entrada" class="block font-semibold mb-1 text-white">Ordem de Entrada</label>
        <textarea id="detalhes_ordem_entrada" name="detalhes[ordem_entrada]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.ordem_entrada', $servico->detalhesCasamento->ordem_entrada ?? '') }}</textarea>
    </div>
    <div>
        <label for="detalhes_coro" class="block font-semibold mb-1 text-white">Coro</label>
        <input type="checkbox" id="detalhes_coro" name="detalhes[coro]" value="1"
            @if(old('detalhes.coro', $servico->detalhesCasamento->coro ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_coro_localizacao" class="block font-semibold mb-1 text-white">Localização do Coro</label>
        <input type="text" id="detalhes_coro_localizacao" name="detalhes[coro_localizacao]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.coro_localizacao', $servico->detalhesCasamento->coro_localizacao ?? '') }}">
    </div>
    <div>
        <label for="detalhes_ordem_leituras" class="block font-semibold mb-1 text-white">Ordem Leituras</label>
        <textarea id="detalhes_ordem_leituras" name="detalhes[ordem_leituras]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.ordem_leituras', $servico->detalhesCasamento->ordem_leituras ?? '') }}</textarea>
    </div>
    <div>
        <label for="detalhes_oferta_ramo" class="block font-semibold mb-1 text-white">Oferta Ramo</label>
        <input type="checkbox" id="detalhes_oferta_ramo" name="detalhes[oferta_ramo]" value="1"
            @if(old('detalhes.oferta_ramo', $servico->detalhesCasamento->oferta_ramo ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_grupo_exterior" class="block font-semibold mb-1 text-white">Foto Grupo Exterior</label>
        <input type="checkbox" id="detalhes_grupo_exterior" name="detalhes[grupo_exterior]" value="1"
            @if(old('detalhes.grupo_exterior', $servico->detalhesCasamento->grupo_exterior ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_instrucoes_saida_igreja" class="block font-semibold mb-1 text-white">Instruções Saída</label>
        <textarea id="detalhes_instrucoes_saida_igreja" name="detalhes[instrucoes_saida_igreja]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.instrucoes_saida_igreja', $servico->detalhesCasamento->instrucoes_saida_igreja ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_igreja" class="block font-semibold mb-1 text-white">Informações Extra</label>
        <textarea id="detalhes_info_extra_igreja" name="detalhes[info_extra_igreja]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_igreja', $servico->detalhesCasamento->info_extra_igreja ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Quinta</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_nome_quinta" class="block font-semibold mb-1 text-white">Nome</label>
        <input type="text" id="detalhes_nome_quinta" name="detalhes[nome_quinta]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_quinta', $servico->detalhesCasamento->nome_quinta ?? '') }}">
    </div>
    <div>
        <label for="detalhes_morada_quinta" class="block font-semibold mb-1 text-white">Morada</label>
        <input type="text" id="detalhes_morada_quinta" name="detalhes[morada_quinta]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_quinta', $servico->detalhesCasamento->morada_quinta ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_instrucoes_quinta" class="block font-semibold mb-1 text-white">Instruções</label>
        <textarea id="detalhes_instrucoes_quinta" name="detalhes[instrucoes_quinta]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.instrucoes_quinta', $servico->detalhesCasamento->instrucoes_quinta ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_timeline" class="block font-semibold mb-1 text-white">Timeline</label>
        <textarea id="detalhes_timeline" name="detalhes[timeline]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.timeline', $servico->detalhesCasamento->timeline ?? '') }}</textarea>
    </div>
</div>
