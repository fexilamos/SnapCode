@extends('layouts.dashboard')

@section('content')

    <h1 class="text-3xl font-bold text-white text-center mt-8 mb-12 font-mono">&lt;GESTÃO DE FUNCIONÁRIOS/&gt;</h1>
    <main class="p-8 flex justify-center font-mono">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl w-full">
            <!-- Card Consultar -->
            <a href="{{ route('funcionarios.index') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/colab.png') }}" alt="Consultar" width="52">
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-white mb-2">Consultar Colaboradores</h3>
                        <p class="text-gray-300 mb-4 leading-relaxed font-mono">
                            Visualize e pesquise informações dos colaboradores registados no sistema.
                        </p>
                    </div>
                </div>
            </a>

            <!-- Card Registar -->
            <a href="{{ route('funcionarios.create') }}" class="bg-slate-600 p-8 rounded-lg border border-slate-500 transition-transform hover:scale-105 hover:border-white block">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-800 rounded-lg flex items-center justify-center">
                            <img src="{{ asset('images/addcolab.png') }}" alt="Registar" width="42">
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
