<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Funcionario;
use App\Models\Material;
use App\Http\Requests\StoreCheckinRequest;
use App\Http\Requests\StoreCheckOutRequest;

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


    public function store(StoreCheckinRequest $request, $servicoId)
    {
       $servico = Servico::findOrFail($servicoId);


        $funcionariosSync = [];
        if ($request->has('funcionarios')) {
            foreach ($request->input('funcionarios') as $funcionarioId => $dados) {
                if (!empty($dados['active']) || !empty($dados['funcao_no_servico'])) {
                    $funcionariosSync[$funcionarioId] = [
                        'data_alocacao_inicio' => $dados['data_alocacao_inicio'] ?? null,
                        'data_alocacao_fim'    => $dados['data_alocacao_fim'] ?? null,
                        'funcao_no_servico'    => $dados['funcao_no_servico'] ?? null,
                    ];
                }
            }
            $servico->funcionarios()->sync($funcionariosSync);
        } else {
            $servico->funcionarios()->detach();
        }

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
    public function checkoutStore(StoreCheckoutRequest $request, $servicoId)
    {
         $servico = Servico::with(['materiais'])->findOrFail($servicoId);

        $materiais = $request->validated()['materiais'] ?? [];
        foreach ($materiais as $materialId => $dados) {
            $servico->materiais()->updateExistingPivot($materialId, [
                'data_devolucao' => $dados['data_devolucao'] ?? now(),
                // outros campos, ex: 'observacoes' => $dados['observacoes'] ?? null
            ]);
        }

        return redirect()
            ->route('servicos.show', $servicoId)
            ->with('success', 'Checkout efetuado com sucesso!');
        }
}

