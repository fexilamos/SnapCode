<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\MaterialEstado;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'cod_categoria' => 'required|exists:Categoria,cod_categoria',
            'cod_marca'     => 'required|exists:Marca,cod_marca',
            'cod_modelo'    => 'required|exists:Modelo,cod_modelo',
            'num_serie'     => 'required|string|max:255|unique:Material,num_serie',
            'cod_estado'    => 'required|exists:Material_Estado,cod_estado',
            'observacoes'   => 'nullable|string',
        ]);

        $material = Material::create([
            'cod_categoria' => $request->cod_categoria,
            'cod_marca' => $request->cod_marca,
            'cod_modelo' => $request->cod_modelo,
            'num_serie' => $request->num_serie,
            'cod_estado' => $request->cod_estado,
            'observacoes' =>$request->observacoes,
        ]);

        return redirect()->route('materiais.index')->with('success', 'Material adicionado com sucesso!');
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
    public function update(Request $request, string $id)
    {
        $material = Material::find($id);

        if (!$material) {
            return redirect()->route('materiais.index')->with('error', 'Material não encontrada');
        }

        $request->validate([
            'cod_categoria' => 'required|exists:Categoria,cod_categoria',
            'cod_marca'     => 'required|exists:Marca,cod_marca',
            'cod_modelo'    => 'required|exists:Modelo,cod_modelo',
            'num_serie'     => 'required|string|max:255|unique:Material,num_serie,' . $id . ',cod_material',
            'cod_estado'    => 'required|exists:Material_Estado,cod_estado',
            'observacoes'   => 'nullable|string',
        ]);

         $material->update([
            'cod_categoria' => $request->cod_categoria,
            'cod_marca' => $request->cod_marca,
            'cod_modelo' => $request->cod_modelo,
            'num_serie' => $request->num_serie,
            'cod_estado' => $request->cod_estado,
            'observacoes' =>$request->observacoes,
        ]);
        return redirect()->route('materiais.index')->with('success', 'Material editado com sucesso!');
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
}
