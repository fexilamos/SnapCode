<?php

namespace App\Http\Controllers;

use App\Models\Avaria;
use Illuminate\Http\Request;

class AvariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avarias = Avaria::with(['material','servico'])->get();
        return view('avaria.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $avarias = Avaria::create($validated);
        return response()->json($avarias,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $avaria = Avaria::with(['material', 'servico'])->find($id);

        if (!$avaria) {
            return response()->json(['message' => 'Registo de Avaria não encontrado'], 404);
        }

        return response()->json($avaria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $avaria = Avaria::find($id);

        if (!$avaria) {
            return response()->json(['message' => 'Registo de Avaria não encontrado'], 404);
        }

        $validated = $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $avaria->update($validated);
        return response()->json($avaria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $avaria = Avaria::find($id);

        if (!$avaria) {
            return response()->json(['message'=>'Registo de Avaria não encontrado'],404);
        }

        $avaria->delete();
        return response()->json(['message'=>'Registo de Avaria apagado com sucesso']);
    }
}
