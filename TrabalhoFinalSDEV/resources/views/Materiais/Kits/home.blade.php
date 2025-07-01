@extends('layouts.dashboard')

@section('content')
    <div class="relative mb-12 mt-8 max-w-7xl mx-auto px-4">
        <a href="{{ route('materiais.home') }}"
            class="absolute left-0 top-1/2 -translate-y-1/2 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl font-bold text-white text-center mt-8 mb-12 font-mono">&lt;GESTÃO DE KITS/&gt;</h1>
    </div>
    <main class="p-8 flex justify-center font-mono">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Consultar -->
            <a href="{{ route('kits.index') }}"
                class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/kit.png') }}" alt="Consultar" width="52">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Consultar Kits</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed font-mono">
                            Visualize e pesquise todos os kits registados no sistema.
                        </p>
                    </div>
                </div>
            </a>

            <!-- Card Registar -->
            <a href="{{ route('kits.create') }}"
                class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/addkit.png') }}" alt="Registar" width="42">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Registar Kit</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Adicione um novo kit ao sistema com os materiais desejados.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </main>
@endsection
