@extends('layouts.dashboard')

@section('content')
    <h1 class="text-2xl font-bold text-white text-center mt-8 mb-8">
        Lista de Eventos -
        @switch($tipo)
            @case('casamento') Casamentos @break
            @case('batizado') Batizados @break
            @case('comunhao_geral') Comunhão Geral @break
            @case('comunhao_particular') Comunhão Particular @break
            @case('corporativo') Corporativos @break
            @default Eventos
        @endswitch
    </h1>
    <div class="p-4 max-w-5xl mx-auto">
        @if($servicos->isEmpty())
            <div class="text-center text-gray-300">Nenhum evento encontrado.</div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-slate-700 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-slate-800 text-white">
                            <th class="px-4 py-2">Nome</th>
                            <th class="px-4 py-2">Cliente</th>
                            <th class="px-4 py-2">Data Início</th>
                            <th class="px-4 py-2">Local</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servicos as $servico)
                            <tr class="border-b border-slate-600 hover:bg-slate-600 transition">
                                <td class="px-4 py-2">{{ $servico->nome_servico }}</td>
                                <td class="px-4 py-2">{{ $servico->cliente->nome ?? '-' }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($servico->data_inicio)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ $servico->localizacao->nome_local ?? '-' }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('servicos.show', $servico->cod_servico) }}" class="text-blue-400 hover:underline mr-4">Ver</a>
                                    <a href="{{ route('servicos.edit', $servico->cod_servico) }}" class="text-yellow-400 hover:underline">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('servicos.index') }}" class="inline-block px-6 py-2 bg-slate-600 text-white rounded hover:bg-slate-700 transition">Voltar</a>
        </div>
    </div>
@endsection
