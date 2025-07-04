@extends('layouts.dashboard')

@section('content')
@if ($errors->any())
    <div class="bg-red-900 text-red-200 border border-red-700 rounded-lg px-6 py-4 mb-8 font-mono uppercase">
        <b>Ocorreram erros no formulário:</b>
        <ul class="list-disc ml-6 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container mx-auto px-4 max-w-4xl font-mono">
    <div class="relative mb-12 mt-8 max-w-4xl mx-auto px-4">
        <div class="flex items-center justify-start mb-6">
            <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                
            </a>
        </div>
        <div class="bg-slate-700 rounded-2xl shadow-2xl p-8 mt-8">
            <h2 class="text-2xl font-bold text-white mb-6 text-center uppercase tracking-widest">Criar Novo Serviço</h2>
            <form method="POST" action="{{ route('servicos.store') }}">
                @csrf
                <div class="flex flex-col gap-8">
                    <!-- Tabela Cliente -->
                    <div class="bg-slate-800 rounded-xl shadow p-6 flex-1 min-w-[320px] border border-slate-600">
                        <h3 class="text-lg font-bold mb-4 text-white text-center uppercase">Dados do Cliente</h3>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Nome do Cliente</label>
                            <input type="text" name="nome_cliente" class="form-input w-full rounded border-gray-300 text-black" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Email do Cliente</label>
                            <input type="email" name="email_cliente" class="form-input w-full rounded border-gray-300 text-black">
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Telefone do Cliente</label>
                            <input type="text" name="telefone_cliente" class="form-input w-full rounded border-gray-300 text-black">
                        </div>
                    </div>
                    <!-- Tabela Evento -->
                    <div class="bg-slate-800 rounded-xl shadow p-6 flex-1 min-w-[320px] border border-slate-600">
                        <h3 class="text-lg font-bold mb-4 text-white text-center uppercase">Dados do Evento</h3>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Nome do Serviço</label>
                            <input type="text" name="nome_servico" class="form-input w-full rounded border-gray-300 text-black" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Data Início</label>
                            <input type="date" name="data_inicio" class="form-input w-full rounded border-gray-300 text-black" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Data Fim</label>
                            <input type="date" name="data_fim" class="form-input w-full rounded border-gray-300 text-black" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Tipo de Evento</label>
                            <select name="cod_tipo_servico" id="tipoEvento" class="form-select w-full rounded border-gray-300 text-black" required>
                                <option value="">Selecione o tipo</option>
                                @foreach($tipos as $tipo)
                                    <option value="{{ $tipo->cod_tipo_servico }}">{{ $tipo->nome_tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-semibold mb-2 uppercase">Local</label>
                            <select name="cod_local_servico" class="form-select w-full rounded border-gray-300 text-black" required>
                                <option value="">Selecione o local</option>
                                @foreach($localizacoes as $local)
                                    <option value="{{ $local->cod_local_servico }}">{{ $local->nome_local }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Campos dinâmicos por tipo de evento -->
                        <div id="camposEspecificos" class="mt-6">
                            @include('servicos.partials.campos-tipo-evento')
                        </div>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <button type="submit" class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center uppercase">Criar Serviço</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectTipo = document.getElementById('tipoEvento');
        const form = document.querySelector('form');
        function mostrarCampos() {
            const tipo = selectTipo.value;
            document.querySelectorAll('.campos-tipo').forEach(div => {
                div.style.display = 'none';
                // Desabilita todos os campos dos tipos não selecionados
                div.querySelectorAll('input, textarea, select').forEach(el => el.disabled = true);
            });
            if(tipo) {
                const div = document.getElementById('campos-tipo-' + tipo);
                if(div) {
                    div.style.display = 'block';
                    // Habilita todos os campos do tipo selecionado
                    div.querySelectorAll('input, textarea, select').forEach(el => el.disabled = false);
                }
            }
        }
        selectTipo.addEventListener('change', mostrarCampos);
        mostrarCampos();
        // Antes do submit, garante que só os campos do tipo selecionado estão habilitados
        form.addEventListener('submit', function() {
            mostrarCampos();
        });
    });
</script>
@endsection
