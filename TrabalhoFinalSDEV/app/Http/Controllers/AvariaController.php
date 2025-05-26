<?php

namespace App\Http\Controllers;

use App\Models\Avaria;
use App\Models\Material;
use App\Models\Servico;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $avaria = Avaria::create([
            'cod_material' => $request->cod_material,
            'cod_servico' => $request->cod_servico,
            'data_registo' => $request->data_registo,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('avarias.index')->with('success', 'Avaria criada com sucesso!');
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
    public function update(Request $request, string $id)
    {
        $avaria = Avaria::find($id);

        if (!$avaria) {
            return redirect()->route('avarias.index')->with('error', 'Avaria não encontrada');
        }

        $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $avaria->update([
            'cod_material' => $request->cod_material,
            'cod_servico' => $request->cod_servico,
            'data_registo' => $request->data_registo,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('avarias.index')->with('success', 'Avaria editada com sucesso!');
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
