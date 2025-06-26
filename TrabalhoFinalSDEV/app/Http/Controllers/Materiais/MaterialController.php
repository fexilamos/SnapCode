<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\MaterialEstado;
use App\Models\Localizacao;
use App\Http\Requests\StoreUpdateMaterialRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
    {
        $query = Material::with(['categoria','marca','modelo','estado']);
        $categoriasSelecionadas = request('categorias', []);
        $search = request('search');

        if (!empty($categoriasSelecionadas)) {
            $query->whereIn('cod_categoria', $categoriasSelecionadas);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('num_serie', 'like', "%$search%")
                  ->orWhereHas('marca', function($q) use ($search) {
                      $q->where('marca', 'like', "%$search%") ;
                  })
                  ->orWhereHas('modelo', function($q) use ($search) {
                      $q->where('modelo', 'like', "%$search%") ;
                  })
                  ->orWhereHas('categoria', function($q) use ($search) {
                      $q->where('categoria', 'like', "%$search%") ;
                  });
            });
        }
        $materiais = $query->paginate(10);
        return view('materiais.index', compact('materiais'));
    }

        public function create()
    {

        $categorias = Categoria::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $estados = MaterialEstado::all();
        $localizacoes = Localizacao::all();
        return view('materiais.create', compact('categorias', 'marcas', 'modelos', 'estados', 'localizacoes'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateMaterialRequest $request)
    {
        $data = $request->all();
        // Buscar todos os cod_material e encontrar o maior número
        $lastNumber = Material::where('cod_material', 'like', 'MAT%')
            ->get()
            ->map(function($mat) {
                if (preg_match('/MAT(\\d+)/', $mat->cod_material, $matches)) {
                    return (int)$matches[1];
                }
                return 0;
            })
            ->max();
        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $data['cod_material'] = 'MAT' . $nextNumber;
        $material = Material::create($data);

        // Se o estado for avariado (3) ou em manutenção (2), cria registo em Avarias
        if (in_array($material->cod_estado, [2, 3])) {
            \App\Models\Avaria::create([
                'cod_material' => $material->cod_material,
                'data_registo' => now(),
                'observacoes' => 'Avaria registada automaticamente',
            ]);
        }

        return redirect()->route('materiais.index')->with('success', 'Material criado com sucesso!');
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
        $old_estado = $material->cod_estado;
        $material->update($request->all());

        // Se o novo estado for avariado (3) ou em manutenção (2) E não existir já uma avaria para este material, cria registo em Avarias
        if (in_array($material->cod_estado, [2, 3])) {
            $hasAvaria = \App\Models\Avaria::where('cod_material', $material->cod_material)->exists();
            if (!$hasAvaria) {
                \App\Models\Avaria::create([
                    'cod_material' => $material->cod_material,
                    'data_registo' => now(),
                    'observacoes' => 'Avaria registada automaticamente (edição)',
                ]);
            }
        }

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

        return view('materiais.home');
    }

}
