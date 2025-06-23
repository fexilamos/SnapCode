@extends('layouts.dashboard')

@section('content')
    <div class="flex items-center justify-between mb-12 mt-8 max-w-2xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-white">Consulta de Funcionários</h1>
        <a href="{{ route('funcionarios.home') }}" class="text-slate-300 hover:text-white transition-colors ml-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>
    <main class="p-8">
        <div class="max-w-3xl mx-auto">
            <!-- Filtros -->
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <div>
                    <label for="searchFunction" class="block text-sm font-medium text-white mb-2">Função</label>
                    <select id="searchFunction" name="searchFunction" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Selecione a função</option>
                        <option value="0">Admin</option>
                        <option value="1">Fotógrafo</option>
                        <option value="2">Videógrafo</option>
                        <option value="3">Piloto de Drone</option>
                        <option value="4">Editor</option>
                        <option value="5">Assistente Técnico</option>
                    </select>
                </div>
                <div>
                    <label for="searchPhone" class="block text-sm font-medium text-white mb-2">Telefone</label>
                    <input type="tel" id="searchPhone" name="searchPhone" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Número de telefone">
                </div>
                <div>
                    <label for="searchEmail" class="block text-sm font-medium text-white mb-2">Email</label>
                    <input type="email" id="searchEmail" name="searchEmail" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="endereco@email.com">
                </div>
                <div>
                    <label for="searchAddress" class="block text-sm font-medium text-white mb-2">Morada</label>
                    <textarea id="searchAddress" name="searchAddress" rows="1" class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Morada completa"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-white mb-2">Competências e Equipamentos</label>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="fotografia" value="fotografia" class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="fotografia" class="text-white font-medium">Fotografia</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="video" value="video" class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="video" class="text-white font-medium">Vídeo</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="drone" value="drone" class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="drone" class="text-white font-medium">Drone</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="edicao" value="edicao" class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="edicao" class="text-white font-medium">Edição</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="som" value="som" class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="som" class="text-white font-medium">Som</label>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="iluminacao" value="iluminacao" class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="iluminacao" class="text-white font-medium">Iluminação</label>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-2 flex justify-end">
                    <button type="button" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-medium transition-colors" onclick="filterEmployees()">Filtrar</button>
                </div>
            </form>
            <!-- Resultados -->
            <div class="bg-slate-700 rounded-lg p-6 border border-slate-500">
                <h3 class="text-xl font-semibold text-white mb-4">Resultados da Pesquisa</h3>
                <div id="resultsContent" class="space-y-4">
                    <div class="text-slate-300 text-center">Use os filtros acima para pesquisar funcionários</div>
                </div>
            </div>
        </div>
    </main>
    <script>
        // Aqui podes colocar a lógica JS para filtrar funcionários (AJAX ou JS puro)
        function filterEmployees() {
            // Exemplo: mostrar mensagem de "Nenhum funcionário encontrado"
            document.getElementById('resultsContent').innerHTML = '<div class="text-slate-400 text-center py-8">Nenhum funcionário encontrado com os critérios especificados</div>';
        }
    </script>
@endsection