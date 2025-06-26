@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-white text-center mt-8 mb-12">Gestão de Eventos</h1>
    <main class="p-8 flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Consultar -->
            <a href="{{ route('servicos.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-green-400 block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/pesquisar.png') }}" class="w-10 h-10 object-contain" alt="Consultar">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Consultar Eventos</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Visualize e pesquise todos os eventos registados no sistema.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Registar -->
            <a href="{{ route('servicos.create') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-blue-400 block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/registar.png') }}" class="w-10 h-10 object-contain" alt="Registar">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Criar Evento</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Adicione novos eventos.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Avarias -->
            <a href="{{ route('avarias.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-yellow-400 block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-yellow-500 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/avarias.png') }}" class="w-10 h-10 object-contain" alt="Avarias">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Check-In</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Faça o check-in de materiais e equipamentos para eventos.
                        </p>
                    </div>
                </div>
            </a>
            <!-- Card Perdas -->
            <a href="{{ route('perdas.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-red-400 block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-red-500 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/perdas.png') }}" class="w-10 h-10 object-contain" alt="Perdas">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Check-Out</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Faça o check-out de materiais e equipamentos para eventos.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </main>
@endsection
