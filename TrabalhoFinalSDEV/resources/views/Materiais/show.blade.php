@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 max-w-lg font-mono">
    <div class="bg-slate-700 rounded-xl shadow-xl p-8 mt-8 font-mono">
        <h2 class="text-2xl font-bold text-white mb-8 text-center font-mono uppercase tracking-widest">DETALHES DO MATERIAL</h2>
        <div class="flex flex-col items-center mb-10">
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
            ][$material->categoria->categoria] ?? 'LOGO.png' : 'LOGO.png')) }}" alt="{{ $material->categoria->categoria ?? '' }}" width="70" class="mb-2">
            <h3 class="text-xl font-bold text-blue-200 font-mono uppercase tracking-wide">{{ $material->categoria->categoria ?? '-' }}</h3>
        </div>
        <div class="grid grid-cols-1 gap-4 mb-8">
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">ID</span>
                <span class="text-white font-mono">{{ $material->cod_material }}</span>
            </div>

            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">MARCA</span>
                <span class="text-white font-mono">{{ $material->marca->marca ?? '-' }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">MODELO</span>
                <span class="text-white font-mono">{{ $material->modelo->modelo ?? '-' }}</span>
            </div>
             <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">Nº DE SÉRIE</span>
                <span class="text-white font-mono">{{ $material->num_serie }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">ESTADO</span>
                <span class="text-white font-mono">{{ $material->estado->estado_nome ?? '-' }}</span>
            </div>
            <div class="flex flex-col pt-2">
                <span class="text-blue-300 font-mono uppercase text-xs mb-1">OBSERVAÇÕES</span>
                <span class="text-white font-mono">{{ $material->observacoes ?: '-' }}</span>
            </div>
        </div>
        <div class="flex justify-center mt-8">
            <a href="{{ route('materiais.index') }}" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white font-mono rounded-lg font-semibold shadow transition-all duration-200 uppercase">Voltar à Lista</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delegação para garantir que funciona após AJAX
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-ver-material')) {
                e.preventDefault();
                const url = e.target.getAttribute('data-url');
                fetch(url)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('modal-content').innerHTML = html;
                        document.getElementById('material-modal').classList.remove('hidden');
                    });
            }
        });
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('material-modal').classList.add('hidden');
        });
        document.getElementById('material-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });
</script>
@endpush
