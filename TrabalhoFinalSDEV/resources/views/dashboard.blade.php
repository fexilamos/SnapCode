@extends('layouts.dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-6">Painel Principal</h1>

<!-- Cards Superiores -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Estatísticas de Eventos -->
    <div class="bg-gray-700 p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold mb-4">📊 Estatísticas de Eventos</h2>
        <ul class="text-sm space-y-2">
            <li>🎉 <strong>Casamentos:</strong> 14</li>
            <li>👶 <strong>Batizados:</strong> 7</li>
            <li>🙏 <strong>Comunhões:</strong> 5</li>
            <li>🎓 <strong>Outros:</strong> 3</li>
        </ul>
        <a href="{{ url('/servicos') }}" class="text-blue-300 mt-3 inline-block hover:underline">Ver todos os serviços →</a>
    </div>

    <!-- Funcionários em Serviço Hoje -->
    <div class="bg-gray-700 p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold mb-2">👥Funcionarios</h2>
        <ul class="text-sm space-y-1">
            @php
                // Considera-se "externo" quem NÃO é Admin (ajuste conforme sua lógica)
                $funcionarios_externos = \App\Models\Funcionario::with('funcoes')
                    ->whereHas('funcoes', function($q) {
                        $q->where('funcao', '!=', 'Admin');
                    })->get();
            @endphp
            @forelse($funcionarios_externos as $funcionario)
                <li>
                    {{ $funcionario->nome }} –
                    {{ $funcionario->funcoes->pluck('funcao')->join('/') }}
                </li>
            @empty
                <li class="text-gray-400">Nenhum funcionário externo encontrado.</li>
            @endforelse
        </ul>
        <a href="{{ route('funcionarios.index') }}" class="text-blue-300 mt-3 inline-block hover:underline">Ver todos os funcionários →</a>
    </div>

    <!-- Materiais em Manutenção -->
    <div class="bg-gray-700 p-6 rounded-2xl shadow">
        <h2 class="text-xl font-semibold mb-2">🛠️ Manutenção</h2>
        <ul class="text-sm space-y-1">
            @php
                $materiais_manutencao = \App\Models\Material::with(['estado','marca','modelo'])
                    ->whereHas('estado', function($q) {
                        $q->where('estado_nome', 'Em Manutenção');
                    })->get();
            @endphp
            @forelse($materiais_manutencao as $material)
                <li>
                    {{ $material->cod_material }}
                    {{ $material->marca ? ' - ' . $material->marca->marca : '' }}
                    {{ $material->modelo ? ' ' . $material->modelo->modelo : '' }}
                    {{ $material->observacoes ? ' – ' . $material->observacoes : '' }}
                </li>
            @empty
                <li class="text-gray-400">Nenhum material em manutenção.</li>
            @endforelse
        </ul>
    </div>
</div>

<!-- Card Inferior - Eventos Recentes e Futuros -->
<div class="mt-8 bg-gray-700 p-6 rounded-2xl shadow">
    <h2 class="text-xl font-semibold mb-4">📅 Eventos Recentes e Futuros</h2>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Passados -->
        <div>
            <h3 class="text-lg font-semibold mb-2">🕘 Eventos Passados</h3>
            <ul class="text-sm space-y-1">
                <li>✅ Casamento Santos – 18 Mai – Braga</li>
                <li>✅ Comunhão Teixeira – 20 Mai – Porto</li>
                <li>✅ Batizado Nogueira – 21 Mai – Coimbra</li>
            </ul>
        </div>

        <!-- Futuros -->
        <div>
            <h3 class="text-lg font-semibold mb-2">⏳ Próximos Eventos</h3>
            <ul class="text-sm space-y-1">
                <li>📆 Casamento Silva – 25 Mai – Braga</li>
                <li>📆 Batizado Costa – 28 Mai – Porto</li>
                <li>📆 Comunhão Lopes – 2 Jun – Coimbra</li>
            </ul>
        </div>
    </div>

    <a href="{{ url('/calendario') }}" class="text-blue-300 mt-4 inline-block hover:underline">Ir para o calendário completo →</a>
</div>
@endsection
