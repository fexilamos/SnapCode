<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Os Meus Serviços</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LOGOabrev.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <style>
@keyframes typing {
    from { width: 0 }
    to { width: 100% }
}
@keyframes blink {
    50% { border-color: transparent }
}

.typing-effect {
    overflow: hidden;
    border-right: 1px solid white;
    white-space: nowrap;
    width: 0;
    animation:
        typing 2s steps(10, end) forwards,
        blink 0.7s step-end infinite;
}

</style>
</head>
<body class="bg-gray-800 text-white font-mono flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-gray-900 flex flex-col justify-between shadow-2xl z-10">
        <div>
            <!-- LOGO -->
            <div class="p-8 text-white text-2xl font-bold font-mono tracking-wide">
                <span class="typing-effect">&lt;SNAP/&gt;</span>
            </div>
        </div>
        <!-- Saudação e Logout sempre no fundo -->
        <div class="p-6 font-mono">
            <p class="text-center mb-4">Olá, {{ Auth::user()->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full py-2 px-4 bg-red-950 hover:bg-red-800 font-mono rounded text-center text-lg">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Conteúdo principal -->
    <div class="flex-1 min-h-screen flex flex-col items-center justify-start py-12">
        <h1 class="text-3xl font-semibold mb-8">&lt;OS MEUS SERVIÇOS/&gt;</h1>
        <div class="w-full max-w-3xl bg-gray-700 p-8 rounded-2xl shadow-xl">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                <img src="{{ asset('images/estatistica.png') }}" alt="Serviços" class="w-7 h-7 inline">Serviços
            </h2>
            @php
                $funcionario = Auth::user()->funcionario;
                $servicos = $funcionario
                    ? \App\Models\Servico::whereHas('funcionarios', function($q) use ($funcionario) {
                        $q->where('funcionarios.cod_funcionario', $funcionario->cod_funcionario);
                    })
                    ->with(['tipoServico', 'localizacao'])
                    ->orderBy('data_inicio', 'asc')
                    ->get()
                    : collect();
            @endphp
            <ul class="text-sm space-y-2">
                @forelse($servicos as $servico)
                    <li class="flex items-center gap-2 bg-gray-800 rounded p-3 mb-2">
                        <span class="font-semibold">{{ $servico->tipoServico->nome_tipo ?? '-' }}</span>
                        – {{ $servico->nome_servico }} –
                        {{ $servico->data_inicio ? $servico->data_inicio->format('d/m/Y') : '-' }} –
                        {{ $servico->localizacao->nome_local ?? '-' }}
                        <a href="{{ route('servicos.show', $servico->cod_servico) }}" class="ml-2 text-blue-300 hover:underline">ver detalhes</a>
                    </li>
                @empty
                    <li class="text-gray-400">Nenhum serviço alocado.</li>
                @endforelse
            </ul>
        </div>
    </div>
</body>
</html>
