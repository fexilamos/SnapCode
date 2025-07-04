@extends('layouts.dashboard')

@section('content')

@if(session('success'))
    <div class="flex justify-center">
        <div class="bg-green-900 text-green-200 border border-green-700 rounded-lg px-6 py-4 mb-8 font-mono uppercase text-center">
            <b>{{ session('success') }}</b>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="flex justify-center">
        <div class="bg-red-900 text-red-200 border border-red-700 rounded-lg px-6 py-4 mb-8 font-mono uppercase text-center">
            <b>{{ session('error') }}</b>
        </div>
    </div>
@endif

    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4">
        <a href="{{ route('servicos.home') }}" class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-white text-center font-mono">&lt;EVENTOS/&gt;</h1>
    </div>
    <main class="p-8 flex justify-center font-mono">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Casamentos -->
            <a href="{{ route('servicos.tipo', ['tipo' => 'casamento']) }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/casamentos.png') }}" class="w-10 h-10 object-contain" alt="Casamentos">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">CASAMENTOS</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Veja todos os eventos de casamento registados.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Batizados -->
            <a href="{{ route('servicos.tipo', ['tipo' => 'batizado']) }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/batismo.png') }}" class="w-10 h-10 object-contain" alt="Batizados">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">BATIZADOS</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Veja todos os eventos de batizado registados.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Comunhão Geral -->
            <a href="{{ route('servicos.tipo', ['tipo' => 'comunhao_geral']) }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/comunhaogeral.png') }}" class="w-10 h-10 object-contain" alt="Comunhão Geral">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">COMUNHÃO GERAL</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Veja todos os eventos de comunhão geral registados.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Comunhão Particular -->
            <a href="{{ route('servicos.tipo', ['tipo' => 'comunhao_particular']) }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/comunhaopart.png') }}" class="w-10 h-10 object-contain" alt="Comunhão Particular">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">COMUNHÃO PARTICULAR</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Veja todos os eventos de comunhão particular registados.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Corporativos -->
            <div class="md:col-span-2 flex justify-center">
                <a href="{{ route('servicos.tipo', ['tipo' => 'corporativo']) }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block w-full max-w-md">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                                <img src="{{ asset('images/corporate.png') }}" class="w-10 h-10 object-contain" alt="Corporativos">
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-white mb-2">EVENTOS CORPORATIVOS</h3>
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Veja todos os eventos corporativos registados.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>
@endsection
