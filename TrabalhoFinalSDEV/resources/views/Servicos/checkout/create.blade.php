@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center py-12 font-mono">
    <h1 class="text-4xl font-mono text-white mb-8 drop-shadow-xl tracking-tight">&lt;REGISTO DE SAÍDA/&gt;</h1>
    <div class="w-full max-w-5xl">

        {{-- FORM DE FILTRO --}}
        <form method="GET" action="{{ route('servicos.checkout.create') }}" id="filtroTipoForm" class="mb-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-mono text-slate-200 mb-2">Tipo de Evento</label>
                    <select name="tipo_evento" id="tipo_evento"
                        class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-900 text-white shadow-md focus:ring-2 focus:ring-blue-500"
                        onchange="document.getElementById('filtroTipoForm').submit()" required>
                        <option value="">Selecione o tipo de evento</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->cod_tipo_servico }}" {{ $tipo_evento == $tipo->cod_tipo_servico ? 'selected' : '' }}>
                                {{ $tipo->nome_tipo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-200 mb-2">Selecionar Evento</label>
                    <select name="evento" id="evento"
                        class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-900 text-white shadow-md focus:ring-2 focus:ring-blue-500"
                        onchange="document.getElementById('filtroTipoForm').submit()"
                        {{ $tipo_evento ? '' : 'disabled' }} required>
                        <option value="">Selecione o evento</option>
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->cod_servico }}" {{ $evento_id == $evento->cod_servico ? 'selected' : '' }}>
                                {{ $evento->nome_servico }}
                                ({{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        @if ($evento_id && $servico)
        <form method="POST" action="{{ route('servicos.checkout.store') }}">
            @csrf
            <input type="hidden" name="evento" value="{{ $evento_id }}">

            {{-- FUNCIONÁRIOS --}}
            <h2 class="text-xl font-bold mb-4 text-slate-100 mt-8">Colaboradores</h2>
            <div id="funcionarios-cards" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                @if(old('funcionarios', $funcionariosAssociados))
                    @foreach(old('funcionarios', $funcionariosAssociados) as $idx => $cod_funcionario)
                        @php
                            $func = $funcionarios->firstWhere('cod_funcionario', $cod_funcionario);
                            $funcoes = $func ? $func->funcoes : collect();
                        @endphp
                        <div class="card-funcionario flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                            </div>
                            <div class="flex-1 w-full">
                                <select name="funcionarios[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow funcionario-select" onchange="actualizarFuncoes(this)" required>
                                    <option value="">Escolha o funcionário</option>
                                    @foreach($funcionarios as $f)
                                        <option value="{{ $f->cod_funcionario }}" {{ $cod_funcionario == $f->cod_funcionario ? 'selected' : '' }}>
                                            {{ $f->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="funcoes[]" class="form-select mt-3 w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow funcao-select" required>
                                    <option value="">Escolha a função</option>
                                    @foreach($funcoes as $fun)
                                        <option value="{{ $fun->cod_funcao }}"
                                            {{ (old('funcoes.' . $idx) ?? $funcoesAssociadas[$cod_funcionario] ?? '') == $fun->cod_funcao ? 'selected' : '' }}>
                                            {{ $fun->funcao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button"
                                class="btn-remove-func absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                                onclick="removeCardFuncionario(this)">
                                &minus;
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="card-funcionario flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                        <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <div class="flex-1 w-full">
                            <select name="funcionarios[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow funcionario-select" onchange="actualizarFuncoes(this)" required>
                                <option value="">Escolha o funcionário</option>
                                @foreach ($funcionarios as $f)
                                    <option value="{{ $f->cod_funcionario }}">{{ $f->nome }}</option>
                                @endforeach
                            </select>
                            <select name="funcoes[]" class="form-select mt-3 w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow funcao-select" required>
                                <option value="">Escolha a função</option>
                            </select>
                        </div>
                        <button type="button"
                            class="btn-remove-func absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                            onclick="removeCardFuncionario(this)">
                            &minus;
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-funcionario"
                class="bg-slate-700 hover:bg-sky-800 transition text-white px-4 py-2 rounded-xl mb-8 shadow font-medium">
                Adicionar Funcionário
            </button>

            {{-- KITS --}}
            <h2 class="text-xl font-bold mb-4 text-slate-100 mt-8">Kits a Associar</h2>

            <div id="kits-alerta-vazio" class="mb-4 text-red-400 font-bold hidden">Não existem mais kits disponíveis!</div>
            <div id="kits-cards" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                @php
                    $kitsSelecionados = old('kits', $kitsAssociados ?? []);
                @endphp

                @if(count($kits) === 0)
                    <div class="text-red-500 font-bold">Não existem kits disponíveis.</div>
                @elseif(count($kitsSelecionados) > 0)
                    @foreach($kitsSelecionados as $selectedKit)
                        <div class="card-kit flex flex-col gap-3 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                            <div class="flex flex-col md:flex-row gap-4 items-center w-full">
                                <select name="kits[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow kit-select" required>
                                    <option value="">Escolha o kit</option>
                                    @foreach($kits as $kit)
                                        <option value="{{ $kit->cod_kit }}"
                                            {{ $selectedKit == $kit->cod_kit ? 'selected' : '' }}>
                                            {{ $kit->nome_kit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button"
                                class="btn-remove-kit absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                                onclick="removeCardKit(this)">
                                &minus;
                            </button>
                        </div>
                    @endforeach
                @else
                    <div class="card-kit flex flex-col gap-3 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group">
                        <div class="flex flex-col md:flex-row gap-4 items-center w-full">
                            <select name="kits[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow kit-select" required>
                                <option value="">Escolha o kit</option>
                                @foreach($kits as $kit)
                                    <option value="{{ $kit->cod_kit }}">{{ $kit->nome_kit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button"
                            class="btn-remove-kit absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition"
                            onclick="removeCardKit(this)">
                            &minus;
                        </button>
                    </div>
                @endif
            </div>
            <button type="button" id="add-kit"
                class="bg-slate-700 hover:bg-sky-800 transition text-white px-4 py-2 rounded-xl mb-8 shadow font-medium">
                Adicionar Kit
            </button>

            <div class="flex justify-end mt-8">
                <button type="submit"
                    class="px-8 py-3 bg-sky-800 hover:bg-slate-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2 shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Guardar registo </span>
                </button>
            </div>
        </form>
        @endif
    </div>
</div>

<script>
    // ========== FUNCIONÁRIOS ==========
    const funcoesPorFuncionario = {};
    @foreach($funcionarios as $f)
        funcoesPorFuncionario[{{ $f->cod_funcionario }}] = [
            @foreach($f->funcoes as $func)
                { id: '{{ $func->cod_funcao }}', nome: '{{ $func->funcao }}' },
            @endforeach
        ];
    @endforeach

    function actualizarFuncoes(selectFuncionario) {
        const val = selectFuncionario.value;
        const funcaoSelect = selectFuncionario.closest('.flex-1').querySelector('.funcao-select');
        funcaoSelect.innerHTML = '<option value="">Escolha a função</option>';
        if (funcoesPorFuncionario[val]) {
            funcoesPorFuncionario[val].forEach(f => {
                let opt = document.createElement('option');
                opt.value = f.id;
                opt.textContent = f.nome;
                funcaoSelect.appendChild(opt);
            });
        }
    }
    function removeCardFuncionario(btn) {
        btn.closest('.card-funcionario').remove();
    }
    document.getElementById('add-funcionario').addEventListener('click', function() {
        const card = document.createElement('div');
        card.className =
            'card-funcionario flex flex-col md:flex-row items-center gap-5 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group';
        card.innerHTML = `
            <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-white text-lg font-bold shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            <div class="flex-1 w-full">
                <select name="funcionarios[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow funcionario-select" onchange="actualizarFuncoes(this)" required>
                    <option value="">Escolha o funcionário</option>
                    @foreach ($funcionarios as $f)
                        <option value="{{ $f->cod_funcionario }}">{{ $f->nome }}</option>
                    @endforeach
                </select>
                <select name="funcoes[]" class="form-select mt-3 w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow funcao-select" required>
                    <option value="">Escolha a função</option>
                </select>
            </div>
            <button type="button" class="btn-remove-func absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition" onclick="removeCardFuncionario(this)">
                &minus;
            </button>
        `;
        document.getElementById('funcionarios-cards').appendChild(card);
    });

    // ========== KITS ==========
    function getAllSelectedKits() {
        return Array.from(document.querySelectorAll('.kit-select'))
            .map(sel => sel.value)
            .filter(v => v !== '');
    }

    function actualizarOpcoesKits() {
        // Impede a escolha duplicada de kits nos vários selects
        const todosSelecionados = getAllSelectedKits();
        document.querySelectorAll('.kit-select').forEach(function(select) {
            Array.from(select.options).forEach(function(option) {
                if (option.value === '') return;
                option.disabled = todosSelecionados.includes(option.value) && select.value !== option.value;
            });
        });

        // Impede adicionar mais selects se todos os kits estão usados
        const btn = document.getElementById('add-kit');
        if (todosSelecionados.length >= {{ count($kits) }}) {
            btn.disabled = true;
            document.getElementById('kits-alerta-vazio').classList.remove('hidden');
        } else {
            btn.disabled = false;
            document.getElementById('kits-alerta-vazio').classList.add('hidden');
        }
    }

    function removeCardKit(btn) {
        btn.closest('.card-kit').remove();
        actualizarOpcoesKits();
    }

    document.getElementById('add-kit').addEventListener('click', function() {
        const kitsDisponiveis = @json($kits->map(fn($k) => ['cod_kit' => $k->cod_kit, 'nome_kit' => $k->nome_kit]));
        const todosSelecionados = getAllSelectedKits();
        if (todosSelecionados.length >= kitsDisponiveis.length) {
            document.getElementById('kits-alerta-vazio').classList.remove('hidden');
            return;
        }

        // Só mostra opções ainda não escolhidas
        let options = '<option value="">Escolha o kit</option>';
        kitsDisponiveis.forEach(kit => {
            if (!todosSelecionados.includes(String(kit.cod_kit))) {
                options += `<option value="${kit.cod_kit}">${kit.nome_kit}</option>`;
            }
        });

        const card = document.createElement('div');
        card.className =
            'card-kit flex flex-col gap-3 bg-slate-900/80 p-6 rounded-2xl shadow border border-slate-700 relative group';
        card.innerHTML = `
            <div class="flex flex-col md:flex-row gap-4 items-center w-full">
                <select name="kits[]" class="form-select w-full rounded-xl border-slate-600 px-4 py-3 bg-slate-800 text-white shadow kit-select" required>
                    ${options}
                </select>
            </div>
            <button type="button" class="btn-remove-kit absolute right-2 top-2 opacity-60 hover:opacity-100 bg-red-500 text-white rounded-full w-8 h-8 text-lg flex items-center justify-center transition" onclick="removeCardKit(this)">
                &minus;
            </button>
        `;
        document.getElementById('kits-cards').appendChild(card);
        actualizarOpcoesKits();
    });

    // Atualiza opções ao mudar select
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('kit-select')) {
            actualizarOpcoesKits();
        }
    });

    // Inicializar já ao carregar a página
    actualizarOpcoesKits();
</script>
@endsection
