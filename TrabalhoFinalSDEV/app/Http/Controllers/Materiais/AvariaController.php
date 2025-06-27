<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Requests\StoreAvariaRequest;
use App\Http\Controllers\Controller;
use App\Models\Avaria;
use App\Models\Material;
use App\Models\Servico;


class AvariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Listar registos reais de avarias, com os relacionamentos necessários, paginados
        $avarias = Avaria::with(['material.categoria', 'material.marca', 'material.modelo', 'material.estado', 'servico'])
            ->orderByDesc('data_registo')
            ->paginate(10);
        return view('materiais.avarias.index', compact('avarias'));
    }

    public function create()
    {
        $materiais = Material::with(['categoria', 'marca', 'modelo'])->get();
        $servicos = Servico::all();
        $estados = \App\Models\MaterialEstado::all();
        return view('materiais.avarias.create', compact('materiais','servicos','estados'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvariaRequest $request)
    {
        $avaria = Avaria::create($request->all());
        // Atualiza o estado do material para o estado selecionado na avaria
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
        return redirect()->route('avarias.index')->with('success', 'Avaria registada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $avaria = Avaria::with(['material', 'servico'])->find($id);

        if (!$avaria) {
            return redirect()->route('avarias.index')->with('error', 'Avaria não encontrada');
        }

        return view('avarias.show', compact('avaria'));
    }

    public function edit($id)
    {
        $avaria = Avaria::find($id);

        if (!$avaria) {
            return redirect()->route('avarias.index')->with('error', 'Avaria não encontrada');
        }

        $materiais = Material::all();
        $servicos = Servico::all();
        $estados = \App\Models\MaterialEstado::all(); // Adicionado para dropdown de estados
        return view('materiais.avarias.edit', compact('avaria', 'materiais', 'servicos', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAvariaRequest $request, string $id)
    {
        $avaria = Avaria::findOrFail($id);
        $avaria->update($request->all());
        // Atualizar estado do material se enviado
        if ($request->filled('cod_estado') && $avaria->material) {
            $avaria->material->cod_estado = $request->cod_estado;
            $estadoOperacional = \App\Models\MaterialEstado::where('estado_nome', 'Operacional')->first();
            if ($estadoOperacional && $request->cod_estado == $estadoOperacional->cod_estado) {
                // Guardar histórico das observações do material antes de limpar
                $old_observacoes = $avaria->material->observacoes;
                if (!empty($old_observacoes)) {
                    \App\Models\Avaria::create([
                        'cod_material' => $avaria->material->cod_material,
                        'data_registo' => now(),
                        'observacoes' => $old_observacoes,
                        'cod_servico' => null,
                    ]);
                }
                // Limpa as observações do material ao passar para Operacional
                $avaria->material->observacoes = null;
                $avaria->material->save();
                // Limpa as observações da avaria antes de remover
                $avaria->observacoes = null;
                $avaria->save();
                $avaria->delete();
                return redirect()->route('avarias.index')->with('success', 'Avaria resolvida e removida da lista!');
            } else {
                // Atualizar observações do material conforme o campo de avaria (apenas se não for Operacional)
                if ($request->has('observacoes')) {
                    $avaria->material->observacoes = $request->observacoes;
                }
                $avaria->material->save();
            }
        }
        return redirect()->route('avarias.index')->with('success', 'Atualização feita com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $avaria = Avaria::find($id);

        if (!$avaria) {
            return redirect()->route('avarias.index')->with('error', 'Avaria não encontrada');
        }

        $avaria->delete();
        return redirect()->route('avarias.index')->with('success', 'Avaria apagada com sucesso');
    }
}
