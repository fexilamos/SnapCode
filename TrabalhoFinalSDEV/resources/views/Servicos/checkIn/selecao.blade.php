@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl text-white font-bold mb-8">Selecionar Serviço para Check-In</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full mx-auto">
        @forelse ($servicos as $servico)
            <a href="{{ route('servicos.checkin.create', ['servico' => $servico->cod_servico]) }}"
               class="bg-slate-600 p-8 rounded-lg border border-slate-500 hover:scale-105 hover:border-white block transition">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <h3 class="text-xl text-white font-semibold">{{ $servico->nome_servico }}</h3>
                        <p class="text-gray-300">Data: {{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</p>
                        <p class="text-gray-400 text-sm mt-2">Clique para iniciar o check-in deste serviço.</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-2 text-center text-slate-400 text-lg">
                Não existem serviços disponíveis para check-in.
            </div>
        @endforelse
    </div>
@endsection
