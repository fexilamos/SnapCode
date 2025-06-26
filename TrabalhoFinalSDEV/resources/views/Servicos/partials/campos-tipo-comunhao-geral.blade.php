<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_fotos_comunhao_geral" class="block font-semibold mb-1 text-gray-800">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_comunhao_geral" name="detalhes[fotos]" value="1">
    </div>
    <div>
        <label for="detalhes_video_comunhao_geral" class="block font-semibold mb-1 text-gray-800">Vídeo</label>
        <input type="checkbox" id="detalhes_video_comunhao_geral" name="detalhes[video]" value="1">
    </div>
    <div>
        <label for="detalhes_drone_comunhao_geral" class="block font-semibold mb-1 text-gray-800">Drone</label>
        <input type="checkbox" id="detalhes_drone_comunhao_geral" name="detalhes[drone]" value="1">
    </div>
    <div>
        <label for="detalhes_sde_comunhao_geral" class="block font-semibold mb-1 text-gray-800">SDE</label>
        <input type="checkbox" id="detalhes_sde_comunhao_geral" name="detalhes[sde]" value="1">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Formato das Fotos</label>
        <input type="text" name="detalhes[formato_fotos]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Valor da Foto (€)</label>
        <input type="number" step="1" name="detalhes[valor_foto]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Formato do Vídeo</label>
        <input type="text" name="detalhes[formato_video]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Valor do Vídeo (€)</label>
        <input type="number" step="1" name="detalhes[valor_video]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora de Chegada à Igreja</label>
        <input type="time" name="detalhes[hora_chegada_igreja]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nº de Crianças</label>
        <input type="number" name="detalhes[num_criancas]" class="form-input w-full rounded border-gray-300 text-black">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra Comunhão</label>
        <textarea name="detalhes[info_extra_comunhao]" class="form-textarea w-full rounded border-gray-300 text-black"></textarea>
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
        <label class="block font-semibold mb-1 text-gray-800">Diplomas</label>
        <input type="checkbox" name="detalhes[diplomas]" value="1">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Foto Grupo Exterior</label>
        <input type="checkbox" name="detalhes[grupo_exterior]" value="1">
    </div>
</div>
