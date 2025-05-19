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
        $avarias = Avaria::with(['material','servico','data_registo','observacoes'])->get();
        return response()->json($avarias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date:Avaria,data_registo',
            'observacoes' => 'nullable|string',
        ]);

        $avarias = Avaria::create($validated);
        return response()->json($avarias,404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
