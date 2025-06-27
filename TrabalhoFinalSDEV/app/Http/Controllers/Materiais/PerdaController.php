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
        // Listar registos reais de perdas, com os relacionamentos necessários, paginados
        $perdas = Perda::with(['material.categoria', 'material.marca', 'material.modelo', 'material.estado', 'servico'])
            ->orderByDesc('data_registo')
            ->paginate(10);
        return view('materiais.perdas.index', compact('perdas'));
    }

    public function create()
    {
        $materiais = Material::with(['categoria', 'marca', 'modelo'])->get();
        $servicos = Servico::all();
        $estados = \App\Models\MaterialEstado::all();
        return view('materiais.perdas.create', compact('materiais','servicos','estados'));
    }

    // Criar nova perda
    public function store(StoreUpdatePerdaRequest $request)
    {
        $perda = Perda::create($request->all());
        // Atualiza o estado do material para o estado selecionado na perda
        if ($request->filled('cod_material') && $request->filled('cod_estado')) {
            $material = \App\Models\Material::find($request->cod_material);
            if ($material) {
                $material->cod_estado = $request->cod_estado;
                // Se houver observações, atualiza também no material
                if ($request->filled('observacoes')) {
                    $material->observacoes = $request->observacoes;
                }
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
        // Atualizar estado do material se enviado
        if ($request->filled('cod_estado') && $perda->material) {
            $perda->material->cod_estado = $request->cod_estado;
            $estadoOperacional = \App\Models\MaterialEstado::where('estado_nome', 'Operacional')->first();
            if ($estadoOperacional && $request->cod_estado == $estadoOperacional->cod_estado) {
                // Guardar histórico das observações do material antes de limpar
                $old_observacoes = $perda->material->observacoes;
                if (!empty($old_observacoes)) {
                    \App\Models\Perda::create([
                        'cod_material' => $perda->material->cod_material,
                        'data_registo' => now(),
                        'observacoes' => $old_observacoes,
                        'cod_servico' => null,
                    ]);
                }
                // Limpa as observações do material ao passar para Operacional
                $perda->material->observacoes = null;
                $perda->material->save();
                // Limpa as observações da perda antes de remover
                $perda->observacoes = null;
                $perda->save();
                $perda->delete();
                return redirect()->route('perdas.index')->with('success', 'Perda resolvida e removida da lista!');
            } else {
                // Atualizar observações do material conforme o campo de perda (apenas se não for Operacional)
                if ($request->has('observacoes')) {
                    $perda->material->observacoes = $request->observacoes;
                }
                $perda->material->save();
            }
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
