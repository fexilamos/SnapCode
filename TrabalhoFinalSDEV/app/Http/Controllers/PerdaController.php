<?php

namespace App\Http\Controllers;

use App\Models\Perda;
use Illuminate\Http\Request;

class PerdaController extends Controller
{
    // Listar todas as perdas
    public function index()
    {
        $perdas = Perda::with(['material','servico'])->get();
        return response()->json($perdas);
    }

    // Criar nova perda
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $perda = Perda::create($validated);
        return response()->json($perda, 201);
    }

    // Mostrar perda específica
    public function show(string $id)
    {
        $perda = Perda::with(['material', 'servico'])->find($id);

        if (!$perda) {
            return response()->json(['message' => 'Registo de Perda não encontrado'], 404);
        }

        return response()->json($perda);
    }

    // Atualizar registo de perda
    public function update(Request $request, string $id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return response()->json(['message' => 'Registo de Perda não encontrado'], 404);
        }

        $validated = $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $perda->update($validated);
        return response()->json($perda);
    }

    // Eliminar perda
    public function destroy(string $id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return response()->json(['message' => 'Registo de Perda não encontrado'], 404);
        }

        $perda->delete();
        return response()->json(['message' => 'Registo de Perda apagado com sucesso']);
    }
}
