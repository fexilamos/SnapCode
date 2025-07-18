<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Evento Corporativo</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="detalhes_fotos_corporativo" class="block font-semibold mb-1 text-white">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_corporativo" name="detalhes[fotos]" value="1"
            @if(old('detalhes.fotos', $servico->detalhesEvCorporativo->fotos ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_video_corporativo" class="block font-semibold mb-1 text-white">Vídeo</label>
        <input type="checkbox" id="detalhes_video_corporativo" name="detalhes[video]" value="1"
            @if(old('detalhes.video', $servico->detalhesEvCorporativo->video ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_drone_corporativo" class="block font-semibold mb-1 text-white">Drone</label>
        <input type="checkbox" id="detalhes_drone_corporativo" name="detalhes[drone]" value="1"
            @if(old('detalhes.drone', $servico->detalhesEvCorporativo->drone ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_sde_corporativo" class="block font-semibold mb-1 text-white">SDE</label>
        <input type="checkbox" id="detalhes_sde_corporativo" name="detalhes[sde]" value="1"
            @if(old('detalhes.sde', $servico->detalhesEvCorporativo->sde ?? false)) checked @endif>
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_hora_chegada_corp" class="block font-semibold mb-1 text-white">Hora Chegada</label>
        <input type="time" id="detalhes_hora_chegada_corp" name="detalhes[hora_chegada_corp]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_chegada_corp', $servico->detalhesEvCorporativo->hora_chegada_corp ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label for="detalhes_info_extra_corp" class="block font-semibold mb-1 text-white">Informação Extra</label>
        <textarea id="detalhes_info_extra_corp" name="detalhes[info_extra_corp]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_corp', $servico->detalhesEvCorporativo->info_extra_corp ?? '') }}</textarea>
    </div>
</div>
