@extends('layouts.dashboard')

@section('content')

<div class="container mx-auto px-4">
    <h2 class="text-2xl text-white font-bold mb-6">Consultar Avarias e Manutenção</h2>

    <!-- Botão Registar Nova Avaria -->
    <div class="flex justify-end mb-8 mt-6"> 
        <a href="{{ route('avarias.create') }}" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 font-semibold transition-colors shadow">
            Registar Nova Avaria
        </a>
    </div>
    <div class="bg-gray-100 rounded-xl shadow p-6 mb-8">
        @if(session('success'))
            <div style="background: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; padding: 12px; border-radius: 6px; margin-bottom: 16px; text-align:center; font-weight:bold;">
                {{ session('success') }}
            </div>
            <script>
                window.onload = function() {
                    var toast = document.getElementById('toast-success');
                    if (toast) {
                        toast.style.display = 'block';
                        setTimeout(function() {
                            toast.style.display = 'none';
                        }, 3000);
                    }
                }
            </script>
            <div id="toast-success" style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); background: #198754; color: #fff; padding: 16px 32px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); font-weight: bold; z-index: 9999; display: none;">
                {{ session('success') }}
            </div>
        @endif
        <form method="GET" action="{{ route('materiais.index') }}" class="mb-4">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text" name="search" class="form-input flex-1 rounded border-gray-300 text-black" placeholder="Pesquisar por nome, marca, modelo..." value="{{ request('search') }}">
                <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" type="submit">Pesquisar</button>
            </div>
        </form>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow mt-4">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-black">ID Avaria</th>
                        <th class="py-2 px-4 text-black">Nº Série</th>
                        <th class="py-2 px-4 text-black">Categoria</th>
                        <th class="py-2 px-4 text-black">Marca</th>
                        <th class="py-2 px-4 text-black">Modelo</th>
                        <th class="py-2 px-4 text-black">Estado</th>
                        <th class="py-2 px-4 text-black">Observações</th>
                        <th class="py-2 px-4 text-black">Data</th>
                        <th class="py-2 px-4 text-black">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($avarias as $avaria)
                        {{-- Os registos já vêm ordenados do controller por data_registo DESC, logo o mais recente aparece em cima --}}
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4 text-black">{{ $avaria->cod_avaria }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->material->num_serie ?? '-' }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->material->categoria->categoria ?? '-' }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->material->marca->marca ?? '-' }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->material->modelo->modelo ?? '-' }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->material->estado->estado_nome ?? '-' }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->observacoes }}</td>
                            <td class="py-2 px-4 text-black">{{ $avaria->data_registo ? \Carbon\Carbon::parse($avaria->data_registo)->format('d/m/Y') : '-' }}</td>
                            <td class="py-2 px-4 flex flex-col gap-1 md:flex-row md:gap-2 justify-center">
                                <a href="{{ route('avarias.edit', $avaria->cod_avaria) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-xs">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-4 text-center text-gray-500">Nenhuma avaria registada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $avarias->links() }}
        </div>
    </div>
</div>
@endsection