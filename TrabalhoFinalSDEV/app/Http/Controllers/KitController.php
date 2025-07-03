<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Material;
use Illuminate\Http\Request;

class KitController extends Controller
{
    
    public function home()
    {
        return view('materiais.kits.home');
    }

    
    public function index(Request $request)
    {
        $kitsQuery = Kit::with('materiais.marca', 'materiais.modelo', 'materiais.categoria');

        if ($request->filled('search')) {
            $kitsQuery->where('nome_kit', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('categoria')) {
            $kitsQuery->whereHas('materiais', function($q) use ($request) {
                $q->where('cod_categoria', $request->categoria);
            });
        }

        $kits = $kitsQuery->orderBy('cod_kit', 'desc')->paginate(15);

        // Puxar categorias para o filtro dropdown
        $categorias = \App\Models\Categoria::orderBy('categoria')->get();

        return view('materiais.kits.index', compact('kits', 'categorias'));
    }

    
    public function create()
    {
        // Materiais que não pertencem a nenhum kit
        $materiais = Material::whereDoesntHave('kits')
            ->with(['marca', 'modelo', 'categoria'])
            ->orderBy('cod_material')->get();

        return view('materiais.kits.create', compact('materiais'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'nome_kit' => 'required|string|max:100',
            'materiais' => 'required|array|min:1',
        ], [
            'materiais.required' => 'Adiciona pelo menos um material ao kit.',
            'materiais.min' => 'Adiciona pelo menos um material ao kit.',
        ]);

        $materiaisSelecionados = array_keys($request->input('materiais', []));

        // Validação: impedir materiais já noutro kit
        $jaEmKit = Material::whereIn('cod_material', $materiaisSelecionados)
            ->whereHas('kits')
            ->pluck('cod_material')
            ->toArray();

        if (count($jaEmKit)) {
            return back()->withErrors(['materiais' => 'Alguns materiais já pertencem a outro kit e não podem ser adicionados.'])->withInput();
        }

        $kit = Kit::create([
            'nome_kit' => $request->nome_kit
        ]);

        // Anexar materiais ao kit
        $pivotData = [];
        foreach ($materiaisSelecionados as $cod_material) {
            $pivotData[$cod_material] = ['quantidade' => 1];
        }
        $kit->materiais()->attach($pivotData);

        return redirect()->route('kits.index')->with('success', 'Kit criado com sucesso!');
    }

    /**
     * Formulário para editar kit (materiais disponíveis + já presentes).
     */
    public function edit($id)
    {
        $kit = Kit::with('materiais')->findOrFail($id);

        // Materiais livres OU já neste kit
        $materiais = Material::where(function($q) use ($kit) {
            $q->whereDoesntHave('kits')
              ->orWhereHas('kits', function($q2) use ($kit) {
                  $q2->where('kits.cod_kit', $kit->cod_kit);
              });
        })
        ->with(['marca', 'modelo', 'categoria'])
        ->orderBy('cod_material')
        ->get();

        return view('materiais.kits.edit', compact('kit', 'materiais'));
    }

    /**
     * Atualiza kit, validação extra.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_kit' => 'required|string|max:100',
            'materiais' => 'required|array|min:1',
        ], [
            'materiais.required' => 'Adiciona pelo menos um material ao kit.',
            'materiais.min' => 'Adiciona pelo menos um material ao kit.',
        ]);

        $kit = Kit::findOrFail($id);
        $materiaisSelecionados = array_keys($request->input('materiais', []));

        // Validação: impedir materiais já noutro kit (exceto este)
        $jaEmKit = Material::whereIn('cod_material', $materiaisSelecionados)
            ->whereHas('kits', function($q) use ($kit) {
                $q->where('kits.cod_kit', '!=', $kit->cod_kit);
            })
            ->pluck('cod_material')
            ->toArray();

        if (count($jaEmKit)) {
            return back()->withErrors(['materiais' => 'Alguns materiais já pertencem a outro kit e não podem ser adicionados.'])->withInput();
        }

        $kit->update([
            'nome_kit' => $request->nome_kit
        ]);

        // Sync materiais do kit
        $pivotData = [];
        foreach ($materiaisSelecionados as $cod_material) {
            $pivotData[$cod_material] = ['quantidade' => 1];
        }
        $kit->materiais()->sync($pivotData);

        return redirect()->route('kits.index')->with('success', 'Kit atualizado com sucesso!');
    }

    /**
     * Apaga kit.
     */
    public function destroy($id)
    {
        $kit = Kit::findOrFail($id);
        $kit->delete();
        return redirect()->route('kits.index')->with('success', 'Kit apagado com sucesso!');
    }
}
