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
        $avarias = Avaria::with(['material','servico'])->get();
        return view('avarias.index', compact('avarias'));
    }

    public function create()
    {
        $materiais = Material::all();
        $servicos = Servico::all();
        return view('avarias.create', compact('materiais','servicos'));
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
        return view('avarias.edit', compact('avaria', 'materiais', 'servicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAvariaRequest $request, string $id)
    {
        $avaria = Avaria::findOrFail($id);
        $avaria->update($request->all());
        return redirect()->route('avarias.index')->with('success', 'Avaria atualizada com sucesso!');
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
