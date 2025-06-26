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
        Avaria::create($request->all());
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
            $avaria->material->save();
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
