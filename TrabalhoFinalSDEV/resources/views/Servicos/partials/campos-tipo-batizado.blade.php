<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Primeira secção: opções de serviço -->
    <div>
        <label for="detalhes_fotos_batizado" class="block font-semibold mb-1 text-gray-800">Fotos</label>
        <input type="checkbox" id="detalhes_fotos_batizado" name="detalhes[fotos]" value="1"
            @if(old('detalhes.fotos', $servico->detalhesBatizado->fotos ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_video_batizado" class="block font-semibold mb-1 text-gray-800">Vídeo</label>
        <input type="checkbox" id="detalhes_video_batizado" name="detalhes[video]" value="1"
            @if(old('detalhes.video', $servico->detalhesBatizado->video ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_drone_batizado" class="block font-semibold mb-1 text-gray-800">Drone</label>
        <input type="checkbox" id="detalhes_drone_batizado" name="detalhes[drone]" value="1"
            @if(old('detalhes.drone', $servico->detalhesBatizado->drone ?? false)) checked @endif>
    </div>
    <div>
        <label for="detalhes_sde_batizado" class="block font-semibold mb-1 text-gray-800">SDE</label>
        <input type="checkbox" id="detalhes_sde_batizado" name="detalhes[sde]" value="1"
            @if(old('detalhes.sde', $servico->detalhesBatizado->sde ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Fotos Convidados</label>
        <input type="checkbox" name="detalhes[fotos_convidados]" value="1"
            @if(old('detalhes.fotos_convidados', $servico->detalhesBatizado->fotos_convidados ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nº Convidados</label>
        <input type="number" name="detalhes[num_convidados_fotos]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.num_convidados_fotos', $servico->detalhesBatizado->num_convidados_fotos ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Venda Fotos</label>
        <input type="checkbox" name="detalhes[venda_fotos]" value="1"
            @if(old('detalhes.venda_fotos', $servico->detalhesBatizado->venda_fotos ?? false)) checked @endif>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Bebé</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora Chegada</label>
        <input type="time" name="detalhes[hora_chegada_casa_bebe]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_chegada_casa_bebe', $servico->detalhesBatizado->hora_chegada_casa_bebe ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Hora Saída</label>
        <input type="time" name="detalhes[hora_saida_casa_bebe]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.hora_saida_casa_bebe', $servico->detalhesBatizado->hora_saida_casa_bebe ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" name="detalhes[nome_bebe]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_bebe', $servico->detalhesBatizado->nome_bebe ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_bebe]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_bebe', $servico->detalhesBatizado->morada_bebe ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Agregado Familiar</label>
        <input type="text" name="detalhes[agregado_bebe]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.agregado_bebe', $servico->detalhesBatizado->agregado_bebe ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea name="detalhes[info_extra_bebe]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_bebe', $servico->detalhesBatizado->info_extra_bebe ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Igreja</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_igreja]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_igreja', $servico->detalhesBatizado->morada_igreja ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <input type="text" name="detalhes[instrucoes_igreja]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.instrucoes_igreja', $servico->detalhesBatizado->instrucoes_igreja ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Coro</label>
        <input type="checkbox" name="detalhes[coro]" value="1"
            @if(old('detalhes.coro', $servico->detalhesBatizado->coro ?? false)) checked @endif>
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Localização do Coro</label>
        <input type="text" name="detalhes[coro_localizacao]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.coro_localizacao', $servico->detalhesBatizado->coro_localizacao ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Foto Grupo Exterior</label>
        <input type="checkbox" name="detalhes[grupo_exterior]" value="1"
            @if(old('detalhes.grupo_exterior', $servico->detalhesBatizado->grupo_exterior ?? false)) checked @endif>
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Informações Extra</label>
        <textarea name="detalhes[info_extra_igreja]" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('detalhes.info_extra_igreja', $servico->detalhesBatizado->info_extra_igreja ?? '') }}</textarea>
    </div>
</div>
<br>
<h4 class="text-lg font-bold text-white mb-2 border-l-4 border-gray-700 pl-3 bg-gray-800 rounded">Quinta</h4>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Nome</label>
        <input type="text" name="detalhes[nome_quinta]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.nome_quinta', $servico->detalhesBatizado->nome_quinta ?? '') }}">
    </div>
    <div>
        <label class="block font-semibold mb-1 text-gray-800">Morada</label>
        <input type="text" name="detalhes[morada_quinta]" class="form-input w-full rounded border-gray-300 text-black"
            value="{{ old('detalhes.morada_quinta', $servico->detalhesBatizado->morada_quinta ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Instruções</label>
        <textarea name="detalhes[instrucoes_quinta]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.instrucoes_quinta', $servico->detalhesBatizado->instrucoes_quinta ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="block font-semibold mb-1 text-gray-800">Timeline</label>
        <textarea name="detalhes[timeline]" class="form-input w-full rounded border-gray-300 text-black">{{ old('detalhes.timeline', $servico->detalhesBatizado->timeline ?? '') }}</textarea>
    </div>
</div>
