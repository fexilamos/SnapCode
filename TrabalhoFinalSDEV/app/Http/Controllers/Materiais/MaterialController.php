<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\MaterialEstado;
use App\Http\Requests\StoreUpdateMaterialRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiais = Material::with(['categoria','marca','modelo','estado'])->get();
        return view('materiais.index', compact('materiais'));
    }

        public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $estados = MaterialEstado::all();
        return view('materiais.create', compact('categorias', 'marcas', 'modelos', 'estados'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateMaterialRequest $request)
    {
        Material::create($request->all());
        return redirect()->route('materiais.index')->with('success', 'Material criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = Material::with(['categoria','marca','modelo','estado'])->find($id);

        if (!$material) {
            return redirect()->route('materiais.index')->with('error', 'Material não encontrada');
        }

        return view('materiais.show', compact('material'));
    }

    public function edit($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return redirect()->route('materiais.index')->with('error', 'Material não encontrada');
        }

        $categorias = Categoria::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $estados = MaterialEstado::all();

        return view('materiais.edit', compact('material','categorias', 'marcas', 'modelos', 'estados'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateMaterialRequest $request, string $id)
    {
        $material = Material::findOrFail($id);
        $material->update($request->all());
        return redirect()->route('materiais.index')->with('success', 'Material atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return redirect()->route('materiais.index')->with('error', 'Material não encontrada');
        }

        $material->delete();
        return redirect()->route('materiais.index')->with('success', 'Material apagado com sucesso');
    }

public function home()
    {

        return view('material.home');
    }

}
