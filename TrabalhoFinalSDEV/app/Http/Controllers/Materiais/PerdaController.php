<?php

namespace App\Http\Controllers\Materiais;

use App\Http\Controllers\Controller;
use App\Models\Perda;
use App\Models\Material;
use App\Models\Servico;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $perda = Perda::create([
            'cod_material' => $request->cod_material,
            'cod_servico' => $request->cod_servico,
            'data_registo' => $request->data_registo,
            'observacoes' => $request->observacoes,
        ]);
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
    public function update(Request $request, string $id)
    {
        $perda = Perda::find($id);

        if (!$perda) {
            return redirect()->route('perdas.index')->with('error', 'Registo não encontrado');
        }

        $request->validate([
            'cod_material' => 'required|exists:Material,cod_material',
            'cod_servico' => 'nullable|exists:Servico,cod_servico',
            'data_registo' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $perda->update([
            'cod_material' => $request->cod_material,
            'cod_servico' => $request->cod_servico,
            'data_registo' => $request->data_registo,
            'observacoes' => $request->observacoes,
        ]);
        return redirect()->route('perdas.index')->with('success', 'Registo criado com sucesso!');
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
