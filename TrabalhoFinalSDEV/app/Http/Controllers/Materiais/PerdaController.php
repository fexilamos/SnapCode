<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Models\Material;
use App\Models\Servico;
use App\Http\Requests\StoreUpdatePerdaRequest;

class PerdaController extends Controller
{
    // Listar todas as perdas
    public function index()
    {
        $search = request('search');
        $perdas = Perda::with(['material.categoria', 'material.marca', 'material.modelo','material.estado', 'servico'])
            ->whereHas('material', function($query) use ($search) {
                if ($search) {
                    $query->where(function($q) use ($search) {
                        $q->where('num_serie', 'like', "%$search%")
                          ->orWhereHas('categoria', function($qc) use ($search) {
                              $qc->where('categoria', 'like', "%$search%")
                          ;})
                          ->orWhereHas('marca', function($qm) use ($search) {
                              $qm->where('marca', 'like', "%$search%")
                          ;})
                          ->orWhereHas('modelo', function($qmo) use ($search) {
                              $qmo->where('modelo', 'like', "%$search%")
                          ;});
                    });
                }
                // Estado 4 = Perdido
                $query->where('cod_estado', 4);
            })
            ->orderByDesc('data_registo')
            ->paginate(10);

        return view('materiais.perdas.index', compact('perdas', 'search'));
    }

    public function create()
    {
        $materiais = Material::with(['categoria', 'marca', 'modelo'])->get();
        $servicos = Servico::all();
        // Filtrar apenas o estado "Perdido" para o dropdown
        $estados = \App\Models\MaterialEstado::where('estado_nome', 'Perdido')->get();
        return view('materiais.perdas.create', compact('materiais','servicos','estados'));
    }

    // Criar nova perda
    public function store(StoreUpdatePerdaRequest $request)
    {
        $perda = Perda::create($request->all());
        // Atualizar o estado do material para 4 (perdido) e observações
        if ($perda && $perda->cod_material) {
            $material = \App\Models\Material::find($perda->cod_material);
            if ($material) {
                $material->cod_estado = 4;
                // Atualiza observações do material com o texto da perda
                $material->observacoes = $perda->observacoes;
                $material->save();
            }
        }
        return redirect()->route('perdas.index')->with('success', 'Perda criada com sucesso!');
    }

    // Mostrar perda específica
    public function show(string $id)
    {
        $perda = Perda::with(['material', 'servico'])->find($id);

        if (!$perda) {
             return redirect()->route('perdas.index')->with('error', 'Registo não encontrado');
        }

        return view('materiais.perdas.show', compact('perda'));
    }

    public function edit($id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return redirect()->route('perdas.index')->with('error', 'Registo não encontrado');
        }

        $materiais = Material::all();
        $servicos = Servico::all();
        $estados = \App\Models\MaterialEstado::all();
        return view('materiais.perdas.edit', compact('perda', 'materiais', 'servicos', 'estados'));
    }
    // Atualizar registo de perda
    public function update(StoreUpdatePerdaRequest $request, string $id)
    {
        $perda = Perda::findOrFail($id);
        $perda->update($request->all());
        if ($request->filled('cod_estado') && $perda->material) {
            $perda->material->cod_estado = $request->cod_estado;
            $perda->material->save();
        }
        return redirect()->route('perdas.index')->with('success', 'Registo atualizado com sucesso!');
    }

    // Eliminar perda
    public function destroy(string $id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return redirect()->route('perdas.index')->with('error', 'Registo não encontrado');
        }

        $perda->delete();
        return redirect()->route('perdas.index')->with('success', 'Registo apagado com sucesso');
    }
}
