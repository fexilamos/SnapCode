<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiais = Material::with(['categoria','marca','modelo','estado'])->get();
        return response()->json($materiais);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cod_categoria' => 'required|exists:Categoria,cod_categoria',
            'cod_marca'     => 'required|exists:Marca,cod_marca',
            'cod_modelo'    => 'required|exists:Modelo,cod_modelo',
            'num_serie'     => 'required|string|max:255|unique:Material,num_serie',
            'cod_estado'    => 'required|exists:Material_Estado,cod_estado',
            'observacoes'   => 'nullable|string',
        ]);

        $material = Material::create($validated);
        return response()->json($material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::with(['categoria','marca','modelo','estado'])->find($id);

        if (!$material) {
            return response()->json(['message' => 'Material não encontrado'], 404);
        }

        return response()->json($material);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'Material não encontrado'], 404);
        }

        $validated = $request->validate([
            'cod_categoria' => 'required|exists:Categoria,cod_categoria',
            'cod_marca'     => 'required|exists:Marca,cod_marca',
            'cod_modelo'    => 'required|exists:Modelo,cod_modelo',
            'num_serie'     => 'required|string|max:255|unique:Material,num_serie,' . $id . ',cod_material',
            'cod_estado'    => 'required|exists:Material_Estado,cod_estado',
            'observacoes'   => 'nullable|string',
        ]);

        $material->update($validated);
        return response()->json($material);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message'=>'Material não encontrado'],404);
        }

        $material->delete();
        return response()->json(['message'=>'Material apagado com sucesso']);
    }
}
