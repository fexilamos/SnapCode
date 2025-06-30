<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Os Meus Serviços</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LOGOabrev.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 text-white font-mono">
    <div class="min-h-screen flex flex-col items-center justify-start py-12">
        <h1 class="text-3xl font-semibold mb-8">Os Meus Serviços</h1>
        <div class="w-full max-w-3xl bg-gray-700 p-8 rounded-2xl shadow-xl">
            <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
                <img src="{{ asset('images/estatistica.png') }}" alt="Serviços" class="w-7 h-7 inline">Meus Serviços
            </h2>
            @php
                $funcionario = Auth::user()->funcionario;
                $servicos = $funcionario
                    ? \App\Models\Servico::whereHas('funcionarios', function($q) use ($funcionario) {
                        $q->where('funcionarios.cod_funcionario', $funcionario->cod_funcionario);
                    })
                    ->with(['tipoServico', 'localizacao'])
                    ->orderByDesc('data_inicio')
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
