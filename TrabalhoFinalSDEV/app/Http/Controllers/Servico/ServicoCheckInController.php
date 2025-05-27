<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Funcionario;
use App\Models\Material;

class ServicoCheckinController extends Controller
{
    // Mostra o formulário de check-in
    public function create($servicoId)
    {
        $servico = Servico::with(['funcionarios', 'materiais'])->findOrFail($servicoId);
        $funcionarios = Funcionario::all();
        $materiais = Material::all();
        return view('servicos.checkin', compact('servico', 'funcionarios', 'materiais'));
    }

    // Guarda as associações de funcionários e materiais (check-in)
    public function store(Request $request, $servicoId)
    {
        $servico = Servico::findOrFail($servicoId);

        // Preparar array para sync dos funcionários
        $funcionariosSync = [];
        if ($request->has('funcionarios')) {
            foreach ($request->input('funcionarios') as $funcionarioId => $dados) {
                // Só associar se o checkbox estiver ativo ou se dados estiverem preenchidos
                if (!empty($dados['active']) || !empty($dados['funcao_no_servico'])) {
                    $funcionariosSync[$funcionarioId] = [
                        'data_alocacao_inicio' => $dados['data_alocacao_inicio'] ?? null,
                        'data_alocacao_fim'    => $dados['data_alocacao_fim'] ?? null,
                        'funcao_no_servico'    => $dados['funcao_no_servico'] ?? null,
                    ];
                }
            }
            // Sincronizar os funcionários com os campos extra
            $servico->funcionarios()->sync($funcionariosSync);
        } else {
            // Se não vier nenhum, remove todos
            $servico->funcionarios()->detach();
        }

        // Preparar array para sync dos materiais
        $materiaisSync = [];
        if ($request->has('materiais')) {
            foreach ($request->input('materiais') as $materialId => $dados) {
                if (!empty($dados['active']) || !empty($dados['data_levantamento'])) {
                    $materiaisSync[$materialId] = [
                        'data_levantamento' => $dados['data_levantamento'] ?? null,
                        'data_devolucao'    => $dados['data_devolucao'] ?? null,
                    ];
                }
            }
            // Sincronizar os materiais com os campos extra
            $servico->materiais()->sync($materiaisSync);
        } else {
            $servico->materiais()->detach();
        }

        return redirect()
            ->route('servicos.show', $servicoId)
            ->with('success', 'Check-in efetuado com sucesso!');
    }

    public function checkoutForm($servicoId)
    {
        $servico = Servico::with(['materiais'])->findOrFail($servicoId);
        return view('servicos.checkout', compact('servico'));
    }

    // Guardar checkout (devolução de materiais)
    public function checkoutStore(Request $request, $servicoId)
    {
        $servico = Servico::with(['materiais'])->findOrFail($servicoId);

        $materiais = $request->input('materiais', []);
        foreach ($materiais as $materialId => $dados) {
            $servico->materiais()->updateExistingPivot($materialId, [
                'data_devolucao' => $dados['data_devolucao'] ?? now(),
                // outros campos se quiseres, ex: 'observacoes' => $dados['observacoes'] ?? null
            ]);
        }

        return redirect()
            ->route('servicos.show', $servicoId)
            ->with('success', 'Checkout efetuado com sucesso!');
    }
}

