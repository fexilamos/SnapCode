@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 max-w-lg font-mono">
    <div class="bg-slate-700 rounded-xl shadow-xl p-8 mt-8 font-mono">
        <h2 class="text-2xl font-bold text-white mb-8 text-center font-mono uppercase tracking-widest">DETALHES DO FUNCIONÁRIO</h2>
        <div class="flex flex-col items-center mb-10">
            <img src="{{ asset('images/colab.png') }}" alt="Funcionário" width="70" class="mb-2">
            <h3 class="text-xl font-bold text-blue-200 font-mono uppercase tracking-wide">{{ $funcionario->nome ?? '-' }}</h3>
        </div>
        <div class="grid grid-cols-1 gap-4 mb-8">
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">ID</span>
                <span class="text-white font-mono">{{ $funcionario->cod_funcionario }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">EMAIL</span>
                <span class="text-white font-mono">{{ $funcionario->mail ?? $funcionario->email ?? '-' }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">TELEMÓVEL</span>
                <span class="text-white font-mono">{{ $funcionario->telefone ?? '-' }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">MORADA</span>
                <span class="text-white font-mono">{{ $funcionario->morada ?? '-' }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">FUNÇÃO</span>
                <span class="text-white font-mono">
                    @if($funcionario->funcoes && $funcionario->funcoes->count())
                        {{ $funcionario->funcoes->pluck('funcao')->join(', ') }}
                    @else
                        -
                    @endif
                </span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">NÍVEL</span>
                <span class="text-white font-mono">{{ $funcionario->nivel ? $funcionario->nivel->nivel : '-' }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-slate-600 pb-2">
                <span class="text-blue-300 font-mono uppercase text-xs">EQUIPAMENTO PRÓPRIO</span>
                <span class="text-white font-mono">{{ $funcionario->tem_equipamento_proprio ? 'Sim' : 'Não' }}</span>
            </div>
        </div>
        <div class="flex justify-center mt-8">
            <a href="{{ route('funcionarios.index') }}" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white font-mono rounded-lg font-semibold shadow transition-all duration-200 uppercase">Voltar à Lista</a>
        </div>
    </div>
</div>
@endsection
