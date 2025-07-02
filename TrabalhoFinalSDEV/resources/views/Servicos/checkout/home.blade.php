@extends('layouts.dashboard')

@section('content')
    <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono">&lt;CHECK-OUT DE EQUIPAMENTO/&gt;</h1>
    <br>
    <br>
    <main class="p-8 flex justify-center font-mono">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Criar Check-Out -->
            <a href="{{ route('servicos.checkout.create') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/checkout.png') }}" class="w-12 h-12 object-contain" alt="Check-Out">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">NOVO CHECK-OUT</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Efetue o check-out (levantamento) de kits e funcionários para um evento.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Consultar Check-Outs -->
            <a href="{{ route('servicos.checkout.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/pesquisar.png') }}" class="w-10 h-10 object-contain" alt="Consultar Check-Outs">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">CONSULTAR CHECK-OUTS</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Veja todos os check-outs efetuados e o histórico de levantamentos.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </main>
@endsection
