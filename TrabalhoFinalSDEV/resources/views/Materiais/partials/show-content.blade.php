<div class="space-y-4">
    <div class="flex items-center gap-4">
        <img src="{{ asset('images/icons/' . ($material->categoria->categoria ? [
            'Câmara' => 'camera.png',
            'Lente' => 'lente.png',
            'Baterias' => 'bateria.png',
            'Tripé' => 'tripe.png',
            'Iluminação' => 'iluminacao.png',
            'Cartões de Memoria' => 'cartaomemoria.png',
            'Microfone' => 'microfone.png',
            'Drone' => 'drone.png',
            'Mochilas' => 'mochila.png',
        ][$material->categoria->categoria] ?? 'LOGO.png' : 'LOGO.png')) }}" alt="{{ $material->categoria->categoria ?? '' }}" width="48">
        <h3 class="text-xl font-bold text-blue-200 font-mono">{{ $material->categoria->categoria ?? '-' }}</h3>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <span class="block text-blue-300 font-mono uppercase text-xs">ID</span>
            <span class="text-white font-mono">{{ $material->cod_material }}</span>
        </div>
        <div>
            <span class="block text-blue-300 font-mono uppercase text-xs">Nº de Série</span>
            <span class="text-white font-mono">{{ $material->num_serie }}</span>
        </div>
        <div>
            <span class="block text-blue-300 font-mono uppercase text-xs">Marca</span>
            <span class="text-white font-mono">{{ $material->marca->marca ?? '-' }}</span>
        </div>
        <div>
            <span class="block text-blue-300 font-mono uppercase text-xs">Modelo</span>
            <span class="text-white font-mono">{{ $material->modelo->modelo ?? '-' }}</span>
        </div>
        <div>
            <span class="block text-blue-300 font-mono uppercase text-xs">Estado</span>
            <span class="text-white font-mono">{{ $material->estado->estado_nome ?? '-' }}</span>
        </div>
        <div>
            <span class="block text-blue-300 font-mono uppercase text-xs">Observações</span>
            <span class="text-white font-mono">{{ $material->observacoes ?: '-' }}</span>
        </div>
    </div>
</div>
