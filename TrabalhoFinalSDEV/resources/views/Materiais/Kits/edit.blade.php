@extends('layouts.dashboard')

@section('content')
<div class="relative mb-12 mt-8 max-w-5xl mx-auto font-mono flex items-center justify-center">
    <a href="{{ route('kits.index') }}" class="absolute left-0 text-slate-300 hover:text-white transition-colors">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
    <h1 class="text-3xl font-bold text-white text-center w-full">&lt;EDITAR KIT/&gt;</h1>
</div>

<main class="p-8 font-mono">
    <div class="max-w-5xl mx-auto">
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="kitEditForm" action="{{ route('kits.update', $kit->cod_kit) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Nome do Kit -->
            <div>
                <label for="nome_kit" class="block text-sm font-medium text-white mb-2">Nome do Kit</label>
                <input type="text"
                       id="nome_kit"
                       name="nome_kit"
                       value="{{ old('nome_kit', $kit->nome_kit) }}"
                       class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Nome do kit"
                       required>
            </div>

            <div class="grid md:grid-cols-2 gap-10">
                <!-- Pesquisa e lista de Materiais -->
                <div>
                    <label for="pesquisa_material" class="block text-sm font-medium text-white mb-3">Pesquisar Material</label>
                    <input type="text" id="pesquisa_material" class="w-full px-3 py-2 bg-slate-700 border border-slate-500 rounded-lg text-white mb-3" placeholder="Digite o nome do material..." onkeyup="filtrarMateriais()">

                    <div id="lista-materiais" class="bg-slate-800 border border-slate-600 rounded-lg shadow p-4 max-h-96 overflow-y-auto">
                        @foreach($materiais as $material)
                            @php
                                $nomeMaterial = trim(
                                    ($material->marca->marca ?? '') . ' ' .
                                    ($material->modelo->modelo ?? '') . ' - ' .
                                    $material->num_serie
                                );
                                $selected = $kit->materiais->pluck('cod_material')->contains($material->cod_material);
                            @endphp
                            @if(!$selected)
                            <div class="material-item flex justify-between items-center py-2 px-2 rounded hover:bg-slate-700 transition cursor-move"
                                 draggable="true"
                                 data-id="{{ $material->cod_material }}"
                                 data-nome="{{ $nomeMaterial }}"
                                 ondragstart="drag(event)">
                                <span class="text-white font-mono">{{ $nomeMaterial }}</span>
                                <span class="text-xs text-slate-400 ml-2">{{ $material->observacoes }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Zona de Drop: Materiais do Kit -->
                <div>
                    <label class="block text-sm font-medium text-white mb-3">Materiais do Kit</label>
                    <div id="dropzone"
                        class="bg-slate-900 border-2 border-dashed border-sky-700 rounded-lg shadow p-4 min-h-48 flex flex-col gap-2"
                        ondrop="drop(event)" ondragover="allowDrop(event)">
                        @php $hasMaterial = false; @endphp
                        @foreach($kit->materiais as $material)
                            @php
                                $nomeMaterial = trim(
                                    ($material->marca->marca ?? '') . ' ' .
                                    ($material->modelo->modelo ?? '') . ' - ' .
                                    $material->num_serie
                                );
                                $hasMaterial = true;
                            @endphp
                            <div class="flex items-center justify-between gap-3 bg-slate-800 px-3 py-2 rounded mt-1" id="matrow-{{ $material->cod_material }}">
                                <input type="hidden" name="materiais[{{ $material->cod_material }}]" value="1">
                                <span class="text-white font-mono">{{ $nomeMaterial }}</span>
                                <button type="button" onclick="removerMaterial('{{ $material->cod_material }}')" class="text-red-400 hover:text-red-600 text-xs ml-2">Remover</button>
                            </div>
                        @endforeach
                        @if(!$hasMaterial)
                            <div id="placeholder-drop" class="text-slate-500 text-center py-6">
                                Arraste materiais para aqui ou pesquise e adicione.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Botões -->
            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('kits.index') }}"
                   class="px-6 py-3 bg-slate-700 hover:bg-sky-800 text-white rounded-lg font-medium transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Atualizar</span>
                </button>
            </div>
        </form>
    </div>
</main>

<script>
// Drag & Drop
function allowDrop(ev) {
    ev.preventDefault();
}
function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.dataset.id + '||' + ev.target.dataset.nome);
}
function drop(ev) {
    ev.preventDefault();
    let data = ev.dataTransfer.getData("text").split('||');
    let cod_material = data[0];
    let nome_material = data[1];

    // Evita duplicados
    if(document.getElementById('matrow-' + cod_material)) return;

    let row = document.createElement('div');
    row.className = "flex items-center justify-between gap-3 bg-slate-800 px-3 py-2 rounded mt-1";
    row.id = 'matrow-' + cod_material;
    row.innerHTML = `
        <input type="hidden" name="materiais[${cod_material}]" value="1">
        <span class="text-white font-mono">${nome_material}</span>
        <button type="button" onclick="removerMaterial('${cod_material}')" class="text-red-400 hover:text-red-600 text-xs ml-2">Remover</button>
    `;
    let dropzone = document.getElementById('dropzone');
    if(document.getElementById('placeholder-drop')) {
        document.getElementById('placeholder-drop').remove();
    }
    dropzone.appendChild(row);
}
function removerMaterial(cod_material) {
    let row = document.getElementById('matrow-' + cod_material);
    if(row) row.remove();
    // Se não houver mais materiais, volta o placeholder
    if(document.querySelectorAll('#dropzone > div[id^="matrow-"]').length === 0) {
        let placeholder = document.createElement('div');
        placeholder.id = 'placeholder-drop';
        placeholder.className = 'text-slate-500 text-center py-6';
        placeholder.innerText = 'Arraste materiais para aqui ou pesquise e adicione.';
        document.getElementById('dropzone').appendChild(placeholder);
    }
}
// Pesquisa instantânea
function filtrarMateriais() {
    let input = document.getElementById('pesquisa_material').value.toLowerCase();
    let items = document.querySelectorAll('.material-item');
    items.forEach(function(item) {
        let nome = item.dataset.nome.toLowerCase();
        item.style.display = nome.includes(input) ? '' : 'none';
    });
}
// Bloquear submit sem materiais
document.getElementById('kitEditForm').addEventListener('submit', function(e) {
    if(document.querySelectorAll('#dropzone > div[id^="matrow-"]').length === 0) {
        alert('Adiciona pelo menos um material ao kit.');
        e.preventDefault();
    }
});
</script>
@endsection
