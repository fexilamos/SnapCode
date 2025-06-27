<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Primeira secção: opções de serviço -->
    <div>
        <label for="detalhes_fotos_comunhao_particular" class="block font-semibold mb-1 text-gray-800">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_comunhao_particular" name="detalhes[fotos]" value="1"
            @if(old('detalhes.fotos', $servico->detalhesComunhaoParticular->fotos ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_video_comunhao_particular" class="block font-semibold mb-1 text-gray-800">Vídeo</label>
        <input type="checkbox" id="detalhes_video_comunhao_particular" name="detalhes[video]" value="1"
            @if(old('detalhes.video', $servico->detalhesComunhaoParticular->video ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_drone_comunhao_particular" class="block font-semibold mb-1 text-gray-800">Drone</label>
        <input type="checkbox" id="detalhes_drone_comunhao_particular" name="detalhes[drone]" value="1"
            @if(old('detalhes.drone', $servico->detalhesComunhaoParticular->drone ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_sde_comunhao_particular" class="block font-semibold mb-1 text-gray-800">SDE</label>
        <input type="checkbox" id="detalhes_sde_comunhao_particular" name="detalhes[sde]" value="1"
            @if(old('detalhes.sde', $servico->detalhesComunhaoParticular->sde ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Fotos Convidados</label>
        <input type="checkbox" name="detalhes[fotos_convidados]" value="1"
            @if(old('detalhes.fotos_convidados', $servico->detalhesComunhaoParticular->fotos_convidados ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nº Convidados</label>
        <input type="number" name="detalhes[num_convidados_fotos]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.num_convidados_fotos', $servico->detalhesComunhaoParticular->num_convidados_fotos ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Venda Fotos</label>
        <input type="checkbox" name="detalhes[venda_fotos]" value="1"
            @if(old('detalhes.venda_fotos', $servico->detalhesComunhaoParticular->venda_fotos ?? false)) checked @endif>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Criança</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora Chegada</label>
        <input type="time" name="detalhes[hora_chegada_casa_crianca]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_chegada_casa_crianca', $servico->detalhesComunhaoParticular->hora_chegada_casa_crianca ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora Saída</label>
        <input type="time" name="detalhes[hora_saida_casa_crianca]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_saida_casa_crianca', $servico->detalhesComunhaoParticular->hora_saida_casa_crianca ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" name="detalhes[nome_crianca]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_crianca', $servico->detalhesComunhaoParticular->nome_crianca ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_crianca]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_crianca', $servico->detalhesComunhaoParticular->morada_crianca ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Agregado Familiar</label>
        <input type="text" name="detalhes[agregado_crianca]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.agregado_crianca', $servico->detalhesComunhaoParticular->agregado_crianca ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea name="detalhes[info_extra_crianca]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_crianca', $servico->detalhesComunhaoParticular->info_extra_crianca ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Igreja</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_igreja]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_igreja', $servico->detalhesComunhaoParticular->morada_igreja ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <textarea name="detalhes[instrucoes_igreja]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.instrucoes_igreja', $servico->detalhesComunhaoParticular->instrucoes_igreja ?? '') }}</textarea>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Coro</label>
        <input type="checkbox" name="detalhes[coro]" value="1"
            @if(old('detalhes.coro', $servico->detalhesComunhaoParticular->coro ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Localização do Coro</label>
        <input type="text" name="detalhes[coro_localizacao]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.coro_localizacao', $servico->detalhesComunhaoParticular->coro_localizacao ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Foto Grupo Exterior</label>
        <input type="checkbox" name="detalhes[grupo_exterior]" value="1"
            @if(old('detalhes.grupo_exterior', $servico->detalhesComunhaoParticular->grupo_exterior ?? false)) checked @endif>
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea name="detalhes[info_extra_igreja]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_igreja', $servico->detalhesComunhaoParticular->info_extra_igreja ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Quinta</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" name="detalhes[nome_quinta]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_quinta', $servico->detalhesComunhaoParticular->nome_quinta ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_quinta]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_quinta', $servico->detalhesComunhaoParticular->morada_quinta ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <textarea name="detalhes[instrucoes_quinta]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.instrucoes_quinta', $servico->detalhesComunhaoParticular->instrucoes_quinta ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Timeline</label>
        <textarea name="detalhes[timeline]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.timeline', $servico->detalhesComunhaoParticular->timeline ?? '') }}</textarea>
    </div>
</div>
