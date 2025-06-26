@extends('layouts.dashboard')

@section('content')
    <h1 class="text-3xl md:text-4xl font-bold text-white text-center">Gestão de Materiais</h1>
    <br>
    <br>
    <main class="p-8 flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Consultar -->
            <a href="{{ route('materiais.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/pesquisar.png') }}" class="w-10 h-10 object-contain" alt="Consultar">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Consultar Materiais</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Visualizar e pesquisar todos os materiais registados no sistema.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Registar -->
            <a href="{{ route('materiais.create') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/registar.png') }}" class="w-10 h-10 object-contain" alt="Registar">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Registar Material</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Adicionar novos materiais e equipamento ao inventário.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Avarias -->
            <a href="{{ route('avarias.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/avarias.png') }}" class="w-10 h-10 object-contain" alt="Avarias">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Avarias</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Registar e acompanhar avarias de materiais.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Perdas -->
            <a href="{{ route('perdas.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/perdas.png') }}" class="w-10 h-10 object-contain" alt="Perdas">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Perdas</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Registo de perdas de materiais.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </main>
@endsection
