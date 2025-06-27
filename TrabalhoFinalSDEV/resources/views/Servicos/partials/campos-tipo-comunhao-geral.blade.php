<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_fotos_comunhao_geral" class="block font-semibold mb-1 text-gray-800">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_comunhao_geral" name="detalhes[fotos]" value="1"
            @if(old('detalhes.fotos', $servico->detalhesComunhaoGeral->fotos ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_video_comunhao_geral" class="block font-semibold mb-1 text-gray-800">Vídeo</label>
        <input type="checkbox" id="detalhes_video_comunhao_geral" name="detalhes[video]" value="1"
            @if(old('detalhes.video', $servico->detalhesComunhaoGeral->video ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_drone_comunhao_geral" class="block font-semibold mb-1 text-gray-800">Drone</label>
        <input type="checkbox" id="detalhes_drone_comunhao_geral" name="detalhes[drone]" value="1"
            @if(old('detalhes.drone', $servico->detalhesComunhaoGeral->drone ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_sde_comunhao_geral" class="block font-semibold mb-1 text-gray-800">SDE</label>
        <input type="checkbox" id="detalhes_sde_comunhao_geral" name="detalhes[sde]" value="1"
            @if(old('detalhes.sde', $servico->detalhesComunhaoGeral->sde ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Formato das Fotos</label>
        <input type="text" name="detalhes[formato_fotos]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.formato_fotos', $servico->detalhesComunhaoGeral->formato_fotos ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Valor da Foto (€)</label>
        <input type="number" step="1" name="detalhes[valor_foto]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.valor_foto', $servico->detalhesComunhaoGeral->valor_foto ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Formato do Vídeo</label>
        <input type="text" name="detalhes[formato_video]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.formato_video', $servico->detalhesComunhaoGeral->formato_video ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Valor do Vídeo (€)</label>
        <input type="number" step="1" name="detalhes[valor_video]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.valor_video', $servico->detalhesComunhaoGeral->valor_video ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora de Chegada à Igreja</label>
        <input type="time" name="detalhes[hora_chegada_igreja]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_chegada_igreja', $servico->detalhesComunhaoGeral->hora_chegada_igreja ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nº de Crianças</label>
        <input type="number" name="detalhes[num_criancas]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.num_criancas', $servico->detalhesComunhaoGeral->num_criancas ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra Comunhão</label>
        <textarea name="detalhes[info_extra_comunhao]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_comunhao', $servico->detalhesComunhaoGeral->info_extra_comunhao ?? '') }}</textarea>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Coro</label>
        <input type="checkbox" name="detalhes[coro]" value="1"
            @if(old('detalhes.coro', $servico->detalhesComunhaoGeral->coro ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Localização do Coro</label>
        <input type="text" name="detalhes[coro_localizacao]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.coro_localizacao', $servico->detalhesComunhaoGeral->coro_localizacao ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Diplomas</label>
        <input type="checkbox" name="detalhes[diplomas]" value="1"
            @if(old('detalhes.diplomas', $servico->detalhesComunhaoGeral->diplomas ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Foto Grupo Exterior</label>
        <input type="checkbox" name="detalhes[grupo_exterior]" value="1"
            @if(old('detalhes.grupo_exterior', $servico->detalhesComunhaoGeral->grupo_exterior ?? false)) checked @endif>
    </div>
</div>
