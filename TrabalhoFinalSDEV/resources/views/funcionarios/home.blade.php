@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-white text-center mt-8 mb-12">Gestão de Funcionários</h1>
    <main class="p-8 flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Consultar -->
            <a href="{{ route('funcionarios.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-blue-400 block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Consultar Colaboradores</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Visualize e pesquise informações dos colaboradores registados no sistema.
                        </p>
                    </div>
                </div>
            </a>

            <!-- Card Registar -->
            <a href="{{ route('funcionarios.create') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-green-400 block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Registar Colaboradores</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed">
                            Adicione novos colaboradores ao sistema com todas as informações necessárias.
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </main>
@endsection