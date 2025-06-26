<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Primeira secção: opções de serviço -->
    <div>
        <label for="detalhes_fotos_batizado" class="block font-semibold mb-1 text-gray-800">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_batizado" name="detalhes[fotos]" value="1">
    </div>
    <div>
        <label for="detalhes_video_batizado" class="block font-semibold mb-1 text-gray-800">Vídeo</label>
        <input type="checkbox" id="detalhes_video_batizado" name="detalhes[video]" value="1">
    </div>
    <div>
        <label for="detalhes_drone_batizado" class="block font-semibold mb-1 text-gray-800">Drone</label>
        <input type="checkbox" id="detalhes_drone_batizado" name="detalhes[drone]" value="1">
    </div>
    <div>
        <label for="detalhes_sde_batizado" class="block font-semibold mb-1 text-gray-800">SDE</label>
        <input type="checkbox" id="detalhes_sde_batizado" name="detalhes[sde]" value="1">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Fotos Convidados</label>
        <input type="checkbox" name="detalhes[fotos_convidados]" value="1">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nº Convidados</label>
        <input type="number" name="detalhes[num_convidados_fotos]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Venda Fotos</label>
        <input type="checkbox" name="detalhes[venda_fotos]" value="1">
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Bebé</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora Chegada</label>
        <input type="time" name="detalhes[hora_chegada_casa_bebe]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora Saída</label>
        <input type="time" name="detalhes[hora_saida_casa_bebe]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" name="detalhes[nome_bebe]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_bebe]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Agregado Familiar</label>
        <input type="text" name="detalhes[agregado_bebe]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea name="detalhes[info_extra_bebe]" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Igreja</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_igreja]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <input type="text" name="detalhes[instrucoes_igreja]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Coro</label>
        <input type="checkbox" name="detalhes[coro]" value="1">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Localização do Coro</label>
        <input type="text" name="detalhes[coro_localizacao]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Foto Grupo Exterior</label>
        <input type="checkbox" name="detalhes[grupo_exterior]" value="1">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea name="detalhes[info_extra_igreja]" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Quinta</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" name="detalhes[nome_quinta]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_quinta]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <textarea name="detalhes[instrucoes_quinta]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Timeline</label>
        <textarea name="detalhes[timeline]" class="form-input w-full rounded border-gray-300 text-black"></textarea>
    </div>
</div>
