<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Primeira secção: opções de serviço -->
    <div>
        <label for="detalhes_fotos_casamento" class="block font-semibold mb-1 text-gray-800">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_casamento" name="detalhes[fotos]" value="1">
    </div>
    <div>
        <label for="detalhes_video_casamento" class="block font-semibold mb-1 text-gray-800">Vídeo</label>
        <input type="checkbox" id="detalhes_video_casamento" name="detalhes[video]" value="1">
    </div>
    <div>
        <label for="detalhes_drone_casamento" class="block font-semibold mb-1 text-gray-800">Drone</label>
        <input type="checkbox" id="detalhes_drone_casamento" name="detalhes[drone]" value="1">
    </div>
    <div>
        <label for="detalhes_sde_casamento" class="block font-semibold mb-1 text-gray-800">SDE</label>
        <input type="checkbox" id="detalhes_sde_casamento" name="detalhes[sde]" value="1">
    </div>
    <div>
        <label for="detalhes_fotos_convidados" class="block font-semibold mb-1 text-gray-800">Fotos Convidados</label>
        <input type="checkbox" id="detalhes_fotos_convidados" name="detalhes[fotos_convidados]" value="1">
    </div>
    <div>
        <label for="detalhes_num_convidados_fotos" class="block font-semibold mb-1 text-gray-800">Nº Convidados</label>
        <input type="number" id="detalhes_num_convidados_fotos" name="detalhes[num_convidados_fotos]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_venda_fotos" class="block font-semibold mb-1 text-gray-800">Venda Fotos</label>
        <input type="checkbox" id="detalhes_venda_fotos" name="detalhes[venda_fotos]" value="1">
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Noivo</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_hora_chegada_casa_noivo" class="block font-semibold mb-1 text-gray-800">Hora Chegada</label>
        <input type="time" id="detalhes_hora_chegada_casa_noivo" name="detalhes[hora_chegada_casa_noivo]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_hora_saida_casa_noivo" class="block font-semibold mb-1 text-gray-800">Hora Saída</label>
        <input type="time" id="detalhes_hora_saida_casa_noivo" name="detalhes[hora_saida_casa_noivo]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_nome_noivo" class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" id="detalhes_nome_noivo" name="detalhes[nome_noivo]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_morada_noivo" class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" id="detalhes_morada_noivo" name="detalhes[morada_noivo]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_agregado_noivo" class="block font-semibold mb-1 text-gray-800">Agregado Familiar</label>
        <input type="text" id="detalhes_agregado_noivo" name="detalhes[agregado_noivo]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_noivo" class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea id="detalhes_info_extra_noivo" name="detalhes[info_extra_noivo]" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Noiva</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_hora_chegada_casa_noiva" class="block font-semibold mb-1 text-gray-800">Hora Chegada</label>
        <input type="time" id="detalhes_hora_chegada_casa_noiva" name="detalhes[hora_chegada_casa_noiva]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_nome_noiva" class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" id="detalhes_nome_noiva" name="detalhes[nome_noiva]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_morada_noiva" class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" id="detalhes_morada_noiva" name="detalhes[morada_noiva]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_agregado_noiva" class="block font-semibold mb-1 text-gray-800">Agregado Familiar</label>
        <input type="text" id="detalhes_agregado_noiva" name="detalhes[agregado_noiva]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_noiva" class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea id="detalhes_info_extra_noiva" name="detalhes[info_extra_noiva]" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Igreja</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_morada_igreja" class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" id="detalhes_morada_igreja" name="detalhes[morada_igreja]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_instrucoes_igreja" class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <textarea id="detalhes_instrucoes_igreja" name="detalhes[instrucoes_igreja]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
    <div>
        <label for="detalhes_ordem_entrada" class="block font-semibold mb-1 text-gray-800">Ordem de Entrada</label>
        <textarea id="detalhes_ordem_entrada" name="detalhes[ordem_entrada]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
    <div>
        <label for="detalhes_coro" class="block font-semibold mb-1 text-gray-800">Coro</label>
        <input type="checkbox" id="detalhes_coro" name="detalhes[coro]" value="1">
    </div>
    <div>
        <label for="detalhes_coro_localizacao" class="block font-semibold mb-1 text-gray-800">Localização do Coro</label>
        <input type="text" id="detalhes_coro_localizacao" name="detalhes[coro_localizacao]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_ordem_leituras" class="block font-semibold mb-1 text-gray-800">Ordem Leituras</label>
        <textarea id="detalhes_ordem_leituras" name="detalhes[ordem_leituras]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
    <div>
        <label for="detalhes_oferta_ramo" class="block font-semibold mb-1 text-gray-800">Oferta Ramo</label>
        <input type="checkbox" id="detalhes_oferta_ramo" name="detalhes[oferta_ramo]" value="1">
    </div>
    <div>
        <label for="detalhes_grupo_exterior" class="block font-semibold mb-1 text-gray-800">Foto Grupo Exterior</label>
        <input type="checkbox" id="detalhes_grupo_exterior" name="detalhes[grupo_exterior]" value="1">
    </div>
    <div>
        <label for="detalhes_instrucoes_saida_igreja" class="block font-semibold mb-1 text-gray-800">Instruções Saída</label>
        <textarea id="detalhes_instrucoes_saida_igreja" name="detalhes[instrucoes_saida_igreja]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_igreja" class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea id="detalhes_info_extra_igreja" name="detalhes[info_extra_igreja]" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Quinta</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_nome_quinta" class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" id="detalhes_nome_quinta" name="detalhes[nome_quinta]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label for="detalhes_morada_quinta" class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" id="detalhes_morada_quinta" name="detalhes[morada_quinta]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_instrucoes_quinta" class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <textarea id="detalhes_instrucoes_quinta" name="detalhes[instrucoes_quinta]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_timeline" class="block font-semibold mb-1 text-gray-800">Timeline</label>
        <textarea id="detalhes_timeline" name="detalhes[timeline]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
