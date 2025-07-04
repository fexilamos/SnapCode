<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RelatorioEvento;
use App\Models\Servico;

class RelatorioEventoController extends Controller
{
    // Lista todos os relatórios pós-evento
    public function index()
    {
        // Carrega todos os relatórios com o evento, funcionários e kits associados
        $relatorios = RelatorioEvento::with([
            'servico.funcionarios',
            'servico.kits'
        ])->orderBy('created_at', 'desc')->get();

        return view('servicos.relatorios.index', compact('relatorios'));
    }

    // Mostra o formulário para preencher relatório pós-evento
    public function create($servicoId)
    {
        // Carrega o serviço com funcionários e kits associados
        $servico = Servico::with(['funcionarios', 'kits'])->findOrFail($servicoId);

        return view('servicos.relatorios.create', compact('servico'));
    }

    // Guarda o relatório na base de dados
    public function store(Request $request)
    {
        // Validação dos campos do relatório
        $validated = $request->validate([
            'cod_servico' => 'required|exists:Servicos,cod_servico',
            'houve_atraso' => 'nullable|boolean',
            'motivo_atraso' => 'nullable|string',
            'houve_incidentes' => 'nullable|boolean',
            'descricao_incidente' => 'nullable|string',
            'highlights_selecionados' => 'nullable|boolean',
            'quinta_espaco' => 'nullable|integer|min:1|max:5',
            'quinta_iluminacao' => 'nullable|integer|min:1|max:5',
            'quinta_estacionamento' => 'nullable|integer|min:1|max:5',
            'quinta_staff' => 'nullable|integer|min:1|max:5',
            'igreja_espaco' => 'nullable|integer|min:1|max:5',
            'igreja_iluminacao' => 'nullable|integer|min:1|max:5',
            'igreja_estacionamento' => 'nullable|integer|min:1|max:5',
            'observacoes' => 'nullable|string',
        ]);

        // Guarda o relatório
        RelatorioEvento::create($validated);

        return redirect()->route('servicos.relatorios.index')
            ->with('success', 'Relatório pós-evento guardado com sucesso!');
    }

    public function show($id) {
    $relatorio = RelatorioEvento::with('servico.funcionarios', 'servico.kits')->findOrFail($id);
    return view('servicos.relatorios.show', compact('relatorio'));
}

}
