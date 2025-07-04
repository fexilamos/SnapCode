@extends('layouts.dashboard')

@section('content')
    <!-- Header -->
    <div class="relative mb-12 mt-8 max-w-2xl mx-auto font-mono flex items-center justify-center">
        <a href="{{ route('funcionarios.index') }}" class="absolute left-0 text-slate-300 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-3xl md:text-3xl font-bold text-white font-mono text-center w-full">&lt;REGISTO DE COLABORADOR/&gt;</h1>
    </div>
    <!-- Content -->
    <main class="p-8 font-mono">
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
                               placeholder="Nome completo do colaborador"
                               required>
                    </div>

                    <!-- Função (Checklist) -->
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Função</label>
                        <div class="flex flex-wrap gap-4">

                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="funcao_fotografo" name="funcoes[]" value="1" {{ in_array('1', old('funcoes', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="funcao_fotografo" class="text-white font-medium">Fotógrafo</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="funcao_videografo" name="funcoes[]" value="2" {{ in_array('2', old('funcoes', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="funcao_videografo" class="text-white font-medium">Videógrafo</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="funcao_drone" name="funcoes[]" value="3" {{ in_array('3', old('funcoes', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="funcao_drone" class="text-white font-medium">Piloto de Drone</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="funcao_editor" name="funcoes[]" value="4" {{ in_array('4', old('funcoes', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="funcao_editor" class="text-white font-medium">Editor</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="funcao_assistente" name="funcoes[]" value="5" {{ in_array('5', old('funcoes', [])) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 rounded focus:ring-blue-500 focus:ring-2">
                                <label for="funcao_assistente" class="text-white font-medium">Assistente Técnico</label>
                            </div>
                        </div>
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
                        <label for="telemovel" class="block text-sm font-medium text-white mb-2">Telemóvel</label>
                        <input type="tel"
                               id="telemovel"
                               name="telemovel"
                               value="{{ old('telemovel') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Número de telemóvel">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="endereco@email.com">
                    </div>

                    <!-- Palavra-passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-2">Palavra-passe</label>
                        <div class="relative">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12"
                                   placeholder="Defina uma palavra-passe"
                                   required>
                            <button type="button" id="togglePassword" tabindex="-1" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400 focus:outline-none">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Morada -->
                    <div>
                        <label for="morada" class="block text-sm font-medium text-white mb-2">Localização</label>
                        <textarea id="morada"
                                  name="morada"
                                  rows="1"
                                  class="w-full px-4 py-3 bg-slate-700 border border-slate-500 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Área de residencia do colaborador">{{ old('morada') }}</textarea>
                    </div>

                    <!-- Equipamento Próprio (Sim/Não) -->
                    <div>
                        <span class="block text-sm font-medium text-white mb-2">Equipamento Próprio</span>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="tem_equipamento_proprio" value="1" {{ old('tem_equipamento_proprio') == '1' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 focus:ring-blue-500 focus:ring-2">
                                <span class="text-white">Sim</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="tem_equipamento_proprio" value="0" {{ old('tem_equipamento_proprio') == '0' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-slate-600 border-slate-500 focus:ring-blue-500 focus:ring-2">
                                <span class="text-white">Não</span>
                            </label>
                        </div>
                    </div>

                    <!-- Botões Cancelar/Salvar -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('funcionarios.create') }}"
                           class="px-6 py-3 bg-slate-700 hover:bg-sky-800 text-white rounded-lg font-medium transition-colors">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2">
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

@push('scripts')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.042-3.368m3.087-2.933A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.421 5.568M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
        }
    });
</script>
@endpush
