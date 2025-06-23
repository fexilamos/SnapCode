@extends('layouts.dashboard')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-12 mt-8 max-w-2xl mx-auto">
        <h1 class="text-3xl md:text-4xl font-bold text-white">Registo de Funcionário</h1>
        <a href="{{ route('funcionarios.index') }}" 
           class="text-slate-300 hover:text-white transition-colors ml-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>
    <!-- Content -->
    <main class="p-8">
        <div class="max-w-2xl mx-auto">
            <!-- Main Form Card -->
            
                
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('funcionarios.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-white mb-2">Nome</label>
                        <input type="text" 
                               id="nome" 
                               name="nome" 
                               value="{{ old('nome') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Nome completo do funcionário"
                               required>
                    </div>

                    <!-- Nível de Acesso -->
                    <div>
                        <label for="cod_nivel" class="block text-sm font-medium text-white mb-2">Nível de Acesso</label>
                        <select id="cod_nivel" 
                                name="cod_nivel" 
                                class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Selecione o nível de acesso</option>
                            <option value="1" {{ old('cod_nivel') == '1' ? 'selected' : '' }}>Nível 1</option>
                            <option value="2" {{ old('cod_nivel') == '2' ? 'selected' : '' }}>Nível 2</option>
                            <option value="3" {{ old('cod_nivel') == '3' ? 'selected' : '' }}>Nível 3</option>
                        </select>
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label for="telefone" class="block text-sm font-medium text-white mb-2">Telefone</label>
                        <input type="tel" 
                               id="telefone" 
                               name="telefone" 
                               value="{{ old('telefone') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Número de telefone">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="mail" class="block text-sm font-medium text-white mb-2">Email</label>
                        <input type="email" 
                               id="mail" 
                               name="mail" 
                               value="{{ old('mail') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="endereco@email.com">
                    </div>

                    <!-- Morada -->
                    <div>
                        <label for="morada" class="block text-sm font-medium text-white mb-2">Morada</label>
                        <textarea id="morada" 
                                  name="morada" 
                                  rows="3"
                                  class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Morada completa">{{ old('morada') }}</textarea>
                    </div>

                    <!-- Competências/Equipamentos -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-4">Competências e Equipamentos</label>
                        <div class="bg-slate-700 rounded-lg p-6 border border-slate-500">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                
                                <!-- Fotografia -->
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="fotografia" 
                                           name="competencias[]" 
                                           value="fotografia"
                                           class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="fotografia" class="text-white font-medium">Fotografia</label>
                                </div>

                                <!-- Vídeo -->
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="video" 
                                           name="competencias[]" 
                                           value="video"
                                           class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="video" class="text-white font-medium">Vídeo</label>
                                </div>

                                <!-- Drone -->
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="pilota_drone" 
                                           name="pilota_drone" 
                                           value="1"
                                           {{ old('pilota_drone') ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="pilota_drone" class="text-white font-medium">Drone</label>
                                </div>

                                <!-- Equipamento Próprio -->
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="tem_equipamento_proprio" 
                                           name="tem_equipamento_proprio" 
                                           value="1"
                                           {{ old('tem_equipamento_proprio') ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="tem_equipamento_proprio" class="text-white font-medium">Equipamento Próprio</label>
                                </div>

                                 <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="funcao_editor" 
                                           name="funcoes[]" 
                                           value="4"
                                           {{ in_array('4', old('funcoes', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="funcao_editor" class="text-white font-medium">Editor</label>
                                </div>

                                <!-- Assistente Técnico -->
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" 
                                           id="funcao_assistente" 
                                           name="funcoes[]" 
                                           value="5"
                                           {{ in_array('5', old('funcoes', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="funcao_assistente" class="text-white font-medium">Assistente Técnico</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botões Cancelar/Salvar -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('funcionarios.create') }}" 
                           class="px-6 py-3 bg-slate-500 hover:bg-slate-400 text-white rounded-lg font-medium transition-colors">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-green-600 hover:bg-green-500 text-white rounded-lg font-medium transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Salvar</span>
                        </button>
                    </div>
                </form>
        
        </div>
    </main>
@endsection
