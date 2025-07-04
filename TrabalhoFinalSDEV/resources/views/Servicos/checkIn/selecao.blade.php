@extends('layouts.dashboard')

@section('content')
    <div class="flex items-center justify-start mb-6 w-full max-w-4xl mx-auto">
        <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>
    <h1 class="text-2xl text-white font-mono mb-8 text-center">&lt;Selecionar Serviço para Check-In/&gt;</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full mx-auto">
        @forelse ($servicos as $servico)
            <a href="{{ route('servicos.checkin.create', ['servico' => $servico->cod_servico]) }}"
               class="bg-slate-600 p-8 rounded-lg border border-slate-500 hover:scale-105 hover:border-white block transition">
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <h3 class="text-xl text-white font-mono">{{ $servico->nome_servico }}</h3>
                        <p class="text-gray-300 font-mono">Data: {{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</p>
                        <p class="text-gray-400 text-sm font-mono mt-2">Clique para iniciar o check-in deste serviço.</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-2 text-center text-slate-400 font-mono text-lg">
                Não existem serviços disponíveis para check-in.
            </div>
        @endforelse
    </div>
@endsection
