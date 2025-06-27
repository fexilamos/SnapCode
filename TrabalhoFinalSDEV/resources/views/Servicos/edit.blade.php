@extends('layouts.dashboard')

@section('content')
    @if ($errors->any())
        <div style="background: #ffdddd; color: #b20000; padding: 10px; border-radius: 6px; margin-bottom: 20px;">
            <b>Ocorreram erros no formulário:</b>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-2xl font-bold text-white mb-6 text-center">Editar Serviço</h2>
        <form method="POST" action="{{ route('servicos.update', $servico->cod_servico) }}">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-8">
                <!-- Tabela Cliente -->
                <div class="bg-white rounded shadow p-6 flex-1 min-w-[320px]">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 text-center">Dados do Cliente</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Nome do Cliente</label>
                        <input type="text" name="nome_cliente"
                            class="form-input w-full rounded border-gray-300 text-black"
                            value="{{ $servico->cliente->nome }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Email do Cliente</label>
                        <input type="email" name="email_cliente"
                            class="form-input w-full rounded border-gray-300 text-black"
                            value="{{ $servico->cliente->mail }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Telefone do Cliente</label>
                        <input type="text" name="telefone_cliente"
                            class="form-input w-full rounded border-gray-300 text-black"
                            value="{{ $servico->cliente->telefone }}">
                    </div>
                </div>
                <!-- Tabela Evento -->
                <div class="bg-white rounded shadow p-6 flex-1 min-w-[320px]">
                    <h3 class="text-lg font-bold mb-4 text-gray-800 text-center">Dados do Evento</h3>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Nome do Serviço</label>
                        <input type="text" name="nome_servico"
                            class="form-input w-full rounded border-gray-300 text-black"
                            value="{{ $servico->nome_servico }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Data Início</label>
                        <input type="date" name="data_inicio"
                            class="form-input w-full rounded border-gray-300 text-black"
                            value="{{ old('data_inicio', $servico->data_inicio ? \Carbon\Carbon::parse($servico->data_inicio)->format('Y-m-d') : '') }}"
                            required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Data Fim</label>
                        <input type="date" name="data_fim" class="form-input w-full rounded border-gray-300 text-black"
                            value="{{ old('data_fim', $servico->data_fim ? \Carbon\Carbon::parse($servico->data_fim)->format('Y-m-d') : '') }}"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Tipo de Evento</label>
                        <select name="cod_tipo_servico" id="tipoEvento"
                            class="form-select w-full rounded border-gray-300 text-black" required disabled>
                            {{-- Não permitir mudar tipo no editar para garantir integridade dos dados de detalhes --}}
                            <option value="">Selecione o tipo</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->cod_tipo_servico }}"
                                    @if ($servico->cod_tipo_servico == $tipo->cod_tipo_servico) selected @endif>{{ $tipo->nome_tipo }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="cod_tipo_servico" value="{{ $servico->cod_tipo_servico }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Local</label>
                        <select name="cod_local_servico" class="form-select w-full rounded border-gray-300 text-black"
                            required>
                            <option value="">Selecione o local</option>
                            @foreach ($localizacoes as $local)
                                <option value="{{ $local->cod_local_servico }}"
                                    @if ($servico->cod_local_servico == $local->cod_local_servico) selected @endif>{{ $local->nome_local }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Campos dinâmicos por tipo de evento -->
                    <div id="camposEspecificos" class="mt-6">
                        @if ($servico->cod_tipo_servico == 1)
                            @include('servicos.partials.campos-tipo-casamento', ['servico' => $servico])
                        @elseif ($servico->cod_tipo_servico == 2)
                            @include('servicos.partials.campos-tipo-batizado', ['servico' => $servico])
                        @elseif ($servico->cod_tipo_servico == 3)
                            @include('servicos.partials.campos-tipo-corporativo', ['servico' => $servico])
                        @elseif ($servico->cod_tipo_servico == 4)
                            @include('servicos.partials.campos-tipo-comunhao-particular', ['servico' => $servico])
                        @elseif ($servico->cod_tipo_servico == 5)
                            @include('servicos.partials.campos-tipo-comunhao-geral', ['servico' => $servico])
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Guardar Alterações</button>
            </div>
        </form>
    </div>
@endsection
