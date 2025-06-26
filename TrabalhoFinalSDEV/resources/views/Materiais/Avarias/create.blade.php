@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 max-w-lg">
    <div class="bg-slate-700 rounded-xl shadow-xl p-8 mt-8">
        <h2 class="text-2xl font-semibold text-white mb-6 text-center">Registar Nova Avaria</h2>
        <form method="POST" action="{{ route('avarias.store') }}">
            @csrf

            <div class="mb-4">
                <label for="cod_categoria" class="block text-white font-semibold mb-2">Tipo de Material</label>
                <select name="cod_categoria" id="cod_categoria" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione a Categoria</option>
                    @foreach($materiais->unique('cod_categoria') as $material)
                        <option value="{{ $material->cod_categoria }}">{{ $material->categoria->categoria ?? $material->cod_categoria }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="cod_marca" class="block text-white font-semibold mb-2">Marca</label>
                <select name="cod_marca" id="cod_marca" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione a Marca</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="cod_modelo" class="block text-white font-semibold mb-2">Modelo</label>
                <select name="cod_modelo" id="cod_modelo" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o Modelo</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="num_serie" class="block text-white font-semibold mb-2">Número de Série</label>
                <select name="num_serie" id="num_serie" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o Número de Série</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="data_registo" class="block text-white font-semibold mb-2">Data de Registo</label>
                <input type="date" name="data_registo" id="data_registo" value="{{ old('data_registo', date('Y-m-d')) }}" class="form-input w-full rounded border-gray-300 text-black" required>
            </div>

            <div class="mb-4">
                <label for="cod_servico" class="block text-white font-semibold mb-2">Serviço (opcional)</label>
                <select name="cod_servico" id="cod_servico" class="form-select w-full rounded border-gray-300 text-black">
                    <option value="">Sem serviço associado</option>
                    @foreach($servicos as $servico)
                        <option value="{{ $servico->cod_servico }}">{{ $servico->nome_servico ?? 'Serviço #' . $servico->cod_servico }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="cod_estado" class="block text-white font-semibold mb-2">Estado do Material</label>
                <select name="cod_estado" id="cod_estado" class="form-select w-full rounded border-gray-300 text-black" required>
                    <option value="">Selecione o estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->cod_estado }}">{{ $estado->estado_nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="observacoes" class="block text-white font-semibold mb-2">Observações</label>
                <textarea name="observacoes" id="observacoes" rows="4" class="form-textarea w-full rounded border-gray-300 text-black">{{ old('observacoes') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="cod_material" class="block text-white font-semibold mb-2">Código do Material Selecionado</label>
                <input type="text" name="cod_material" id="cod_material" class="form-input w-full rounded border-gray-300 text-black bg-gray-200" readonly required>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-8 py-3 bg-slate-600 hover:bg-slate-700 text-white rounded-lg font-semibold shadow transition-all duration-200 text-center">
                    Registar Avaria
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const materiais = @json($materiais);

    function getUniqueBy(arr, key) {
        const seen = new Set();
        return arr.filter(item => {
            if (!item[key] || seen.has(item[key])) return false;
            seen.add(item[key]);
            return true;
        });
    }

    function popularDropdown(selectId, options, textKey, valueKey) {
        const select = document.getElementById(selectId);
        select.innerHTML = '<option value="">Selecione ' + select.getAttribute('data-label') + '</option>';
        options.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt[valueKey];
            option.textContent = opt[textKey] ?? opt[valueKey];
            select.appendChild(option);
        });
    }

    function filtrarMateriais() {
        const categoria = document.getElementById('cod_categoria').value;
        const marca = document.getElementById('cod_marca').value;
        const modelo = document.getElementById('cod_modelo').value;
        let filtrados = materiais;
        if (categoria) filtrados = filtrados.filter(m => String(m.cod_categoria) === String(categoria));
        if (marca) filtrados = filtrados.filter(m => String(m.cod_marca) === String(marca));
        if (modelo) filtrados = filtrados.filter(m => String(m.cod_modelo) === String(modelo));
        return filtrados;
    }

    document.getElementById('cod_categoria').addEventListener('change', function() {
        const filtrados = filtrarMateriais();
        // Marcas válidas para a categoria
        const marcas = getUniqueBy(
            filtrados.map(m => ({
                cod_marca: m.cod_marca,
                marca: (m.marca && typeof m.marca === 'object' && m.marca.marca) ? m.marca.marca : (m.marca ? m.marca : m.cod_marca)
            })),
            'cod_marca'
        );
        popularDropdown('cod_marca', marcas, 'marca', 'cod_marca');
        document.getElementById('cod_modelo').innerHTML = '<option value="">Selecione o Modelo</option>';
        document.getElementById('num_serie').innerHTML = '<option value="">Selecione o Número de Série</option>';
        atualizarCodMaterial();
    });

    document.getElementById('cod_marca').addEventListener('change', function() {
        const filtrados = filtrarMateriais();
        // Modelos válidos para categoria+marca
        const modelos = getUniqueBy(
            filtrados.map(m => ({
                cod_modelo: m.cod_modelo,
                modelo: (m.modelo && typeof m.modelo === 'object' && m.modelo.modelo) ? m.modelo.modelo : (m.modelo ? m.modelo : m.cod_modelo)
            })),
            'cod_modelo'
        );
        popularDropdown('cod_modelo', modelos, 'modelo', 'cod_modelo');
        document.getElementById('num_serie').innerHTML = '<option value="">Selecione o Número de Série</option>';
        atualizarCodMaterial();
    });

    document.getElementById('cod_modelo').addEventListener('change', function() {
        const filtrados = filtrarMateriais();
        // Números de série válidos para categoria+marca+modelo
        const nums = getUniqueBy(
            filtrados.map(m => ({ num_serie: m.num_serie })),
            'num_serie'
        );
        popularDropdown('num_serie', nums, 'num_serie', 'num_serie');
        atualizarCodMaterial();
    });

    document.getElementById('num_serie').addEventListener('change', atualizarCodMaterial);

    function atualizarCodMaterial() {
        const categoria = document.getElementById('cod_categoria').value;
        const marca = document.getElementById('cod_marca').value;
        const modelo = document.getElementById('cod_modelo').value;
        const numSerie = document.getElementById('num_serie').value;
        if (!categoria || !marca || !modelo || !numSerie) {
            document.getElementById('cod_material').value = '';
            return;
        }
        const material = materiais.find(m =>
            String(m.cod_categoria) === String(categoria) &&
            String(m.cod_marca) === String(marca) &&
            String(m.cod_modelo) === String(modelo) &&
            String(m.num_serie) === String(numSerie)
        );
        document.getElementById('cod_material').value = material ? material.cod_material : '';
    }

    // Adicionar data-labels para UX
    document.getElementById('cod_marca').setAttribute('data-label', 'a Marca');
    document.getElementById('cod_modelo').setAttribute('data-label', 'o Modelo');
    document.getElementById('num_serie').setAttribute('data-label', 'o Número de Série');

    // Inicializar dropdowns se já houver valores (ex: old input)
    window.addEventListener('DOMContentLoaded', function() {
        atualizarCodMaterial();
    });

    // Popular dropdown de categoria com nomes legíveis (já está no blade, mas garantir para consistência)
    document.getElementById('cod_categoria').querySelectorAll('option').forEach(opt => {
        if (opt.value && !opt.textContent.includes('Selecione')) {
            const material = materiais.find(m => String(m.cod_categoria) === String(opt.value));
            if (material && material.categoria && material.categoria.categoria) {
                opt.textContent = material.categoria.categoria;
            }
        }
    });
</script>
@endsection
