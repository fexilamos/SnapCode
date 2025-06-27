@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center py-12">
    <h1 class="text-4xl font-extrabold text-white mb-8 drop-shadow-xl tracking-tight">Check-out</h1>
    <br><br>
    <div class="w-full max-w-5xl">
        {{-- FORM DE FILTRO --}}
        <form method="GET" action="{{ route('servicos.checkout') }}" id="filtroTipoForm" class="mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-bold text-slate-200 mb-2">Tipo de Evento</label>
                    <select name="tipo_evento" id="tipo_evento" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-900 text-white shadow-md focus:ring-2 focus:ring-blue-500" onchange="document.getElementById('filtroTipoForm').submit()" required>
                        <option value="">Selecione o tipo de evento</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->cod_tipo_servico }}" {{ $tipo_evento == $tipo->cod_tipo_servico ? 'selected' : '' }}>
                                {{ $tipo->nome_tipo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-200 mb-2">Selecionar Evento</label>
                    <select name="evento" id="evento" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-900 text-white shadow-md focus:ring-2 focus:ring-blue-500" onchange="document.getElementById('filtroTipoForm').submit()" {{ $tipo_evento ? '' : 'disabled' }} required>
                        <option value="">Selecione o evento</option>
                        @foreach($eventos as $evento)
                            <option value="{{ $evento->cod_servico }}" {{ $evento_id == $evento->cod_servico ? 'selected' : '' }}>
                                {{ $evento->nome_servico }} ({{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if($evento_id && $servico)
        <form method="POST" action="{{ route('servicos.checkout.store') }}">
            @csrf
            <input type="hidden" name="evento" value="{{ $evento_id }}">

            {{-- FUNCIONÁRIOS --}}
            <h2 class="text-xl font-bold mb-4 text-slate-100 mt-8">Funcionários</h2>
            <div id="funcionarios-cards" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                @if(old('funcionarios', $funcionariosAssociados))
                    @foreach(old('funcionarios', $funcionariosAssociados) as $idx => $cod_funcionario)
                        <div class="card-funcionario flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                            <div class="flex-1 w-full">
                                <select name="funcionarios[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required>
                                    <option value="">Escolha o funcionário</option>
                                    @foreach($funcionarios as $f)
                                        <option value="{{ $f->cod_funcionario }}" {{ $cod_funcionario == $f->cod_funcionario ? 'selected' : '' }}>
                                            {{ $f->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn-remove-func absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                                onclick="removeCardFuncionario(this)">
                                &minus;
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="card-funcionario flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                        <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <div class="flex-1 w-full">
                            <select name="funcionarios[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required>
                                <option value="">Escolha o funcionário</option>
                                @foreach($funcionarios as $f)
                                    <option value="{{ $f->cod_funcionario }}">{{ $f->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn-remove-func absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                            onclick="removeCardFuncionario(this)">
                            &minus;
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-funcionario" class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-xl mb-8 shadow">Adicionar Funcionário</button>

            {{-- MATERIAIS --}}
            <h2 class="text-xl font-bold mb-4 text-slate-100 mt-8">Materiais</h2>
            <div id="materiais-cards" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div class="card-material flex flex-col gap-3 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                    <div class="flex flex-col md:flex-row gap-4 items-center w-full">
                        <select class="select-categoria form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required onchange="atualizarMateriaisDropdown(this)">
                            <option value="">Escolha a categoria</option>
                            @php
                                $categorias = $materiais->pluck('categoria')->unique();
                            @endphp
                            @foreach($categorias as $cat)
                                <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                            @endforeach
                        </select>
                        <select name="materiais[]" class="dropdown-material form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required>
                            <option value="">Escolha o material</option>
                        </select>
                    </div>
                    <button type="button" class="btn-remove-mat absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                        onclick="removeCardMaterial(this)">
                        &minus;
                    </button>
                </div>
            </div>
            <button type="button" id="add-material" class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-xl mb-8 shadow">Adicionar Material</button>

            <div class="flex justify-center mt-8">
                <button type="submit" class="bg-green-600 hover:bg-green-700 transition text-white px-10 py-3 rounded-2xl font-semibold text-lg shadow-xl">Guardar Check-out</button>
            </div>
        </form>
        @endif
    </div>
</div>

<script>
    // FUNCIONÁRIOS
    function removeCardFuncionario(btn) {
        btn.closest('.card-funcionario').remove();
    }
    document.getElementById('add-funcionario').addEventListener('click', function () {
        const card = document.createElement('div');
        card.className = 'card-funcionario flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group';
        card.innerHTML = `
            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <div class="flex-1 w-full">
                <select name="funcionarios[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required>
                    <option value="">Escolha o funcionário</option>
                    @foreach($funcionarios as $f)
                        <option value="{{ $f->cod_funcionario }}">{{ $f->nome }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" class="btn-remove-func absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition" onclick="removeCardFuncionario(this)">
                &minus;
            </button>
        `;
        document.getElementById('funcionarios-cards').appendChild(card);
    });

    // MATERIAIS (categoria + material dependente)
    function removeCardMaterial(btn) {
        btn.closest('.card-material').remove();
    }

    document.getElementById('add-material').addEventListener('click', function () {
        const card = document.createElement('div');
        card.className = 'card-material flex flex-col gap-3 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group';
        card.innerHTML = `
            <div class="flex flex-col md:flex-row gap-4 items-center w-full">
                <select class="select-categoria form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required onchange="atualizarMateriaisDropdown(this)">
                    <option value="">Escolha a categoria</option>
                    @php
                        $categorias = $materiais->pluck('categoria')->unique();
                    @endphp
                    @foreach($categorias as $cat)
                        <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
                <select name="materiais[]" class="dropdown-material form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow" required>
                    <option value="">Escolha o material</option>
                </select>
            </div>
            <button type="button" class="btn-remove-mat absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition" onclick="removeCardMaterial(this)">
                &minus;
            </button>
        `;
        document.getElementById('materiais-cards').appendChild(card);
    });

    // JS: Materiais por categoria
    const materiaisPorCategoria = {};
    @foreach($materiais as $m)
        if (!materiaisPorCategoria['{{ $m->categoria }}']) materiaisPorCategoria['{{ $m->categoria }}'] = [];
        materiaisPorCategoria['{{ $m->categoria }}'].push({id: '{{ $m->cod_material }}', nome: '{{ $m->modelo ? $m->modelo->nome_modelo : '' }} ({{ $m->cod_material }})'});
    @endforeach

    function atualizarMateriaisDropdown(selectCat) {
        const categoria = selectCat.value;
        const dropdownMaterial = selectCat.parentElement.querySelector('.dropdown-material');
        dropdownMaterial.innerHTML = '<option value="">Escolha o material</option>';
        if (categoria && materiaisPorCategoria[categoria]) {
            materiaisPorCategoria[categoria].forEach(m => {
                const opt = document.createElement('option');
                opt.value = m.id;
                opt.textContent = m.nome;
                dropdownMaterial.appendChild(opt);
            });
        }
    }
</script>
@endsection
