<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Models\Material;
use App\Models\Servico;
use App\Http\Requests\StoreUpdatePerdaRequest;

class PerdaController extends Controller
{
    // Listar todas as perdas
    public function index()
    {
        $perdas = Perda::with(['material','servico'])->get();
        return view('perdas.index', compact('perdas'));
    }

    public function create()
    {
        $materiais = Material::all();
        $servicos = Servico::all();
        return view('perdas.create', compact('materiais','servicos'));
    }

    // Criar nova perda
    public function store(StoreUpdatePerdaRequest $request)
    {
        Perda::create($request->all());
        return redirect()->route('perdas.index')->with('success', 'Registo criado com sucesso!');
    }

    // Mostrar perda específica
    public function show(string $id)
    {
        $perda = Perda::with(['material', 'servico'])->find($id);

        if (!$perda) {
             return redirect()->route('perdas.index')->with('error', 'Registo não encontrado');
        }

        return view('perdas.show', compact('perda'));
    }

    public function edit($id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return redirect()->route('perdas.index')->with('error', 'Registo não encontrado');
        }

        $materiais = Material::all();
        $servicos = Servico::all();
        return view('perdas.edit', compact('perda', 'materiais', 'servicos'));
    }
    // Atualizar registo de perda
    public function update(StoreUpdatePerdaRequest $request, string $id)
    {
        $avaria = Perda::findOrFail($id);
        $avaria->update($request->all());
        return redirect()->route('perdas.index')->with('success', 'Registo atualizado com sucesso!');
    }

    // Eliminar perda
    public function destroy(string $id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return redirect()->route('perdas.index')->with('error', 'Registo não encontrada');
        }

        $perda->delete();
        return redirect()->route('perdas.index')->with('success', 'Registo apagado com sucesso');
    }
}
