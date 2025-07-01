@extends('layouts.dashboard')

@section('content')
    <h1 class="text-3xl md:text-3xl font-bold text-white text-center font-mono">&lt;GESTÃO DE EVENTOS/&gt;</h1>
    <br>
    <br>
    <main class="p-8 flex justify-center font-mono">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Consultar -->
            <a href="{{ route('servicos.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/pesquisar.png') }}" class="w-10 h-10 object-contain" alt="Consultar">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">CONSULTAR EVENTOS</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Visualize e pesquise todos os eventos registados no sistema.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Registar -->
            <a href="{{ route('servicos.create') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/registar.png') }}" class="w-10 h-10 object-contain" alt="Registar">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">CRIAR EVENTOS</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Adicione novos eventos.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Check-In -->
            <a href="{{ route('avarias.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/checkin.png') }}" class="w-12 h-12 object-contain" alt="Check-In">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">CHECK-IN</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Faça o check-in de materiais e equipamentos para eventos.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Check-Out -->
            <a href="{{ route('servicos.checkout.home') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/checkout.png') }}" class="w-12 h-12 object-contain" alt="Check-Out">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">CHECK-OUT</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Faça o check-out de materiais e equipamentos para eventos.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </main>
@endsection
