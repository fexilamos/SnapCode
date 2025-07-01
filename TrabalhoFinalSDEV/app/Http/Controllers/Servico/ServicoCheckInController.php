<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\TiposServico;
use App\Models\Funcionario;
use App\Models\Kit;

class ServicoCheckinController extends Controller
{
    // FORMULÁRIO DE CHECK-OUT (levantamento dos kits)
    public function formCheckout(Request $request)
    {
        $tipos = TiposServico::all();

        // Eventos filtrados por tipo, se selecionado
        $tipo_evento = $request->get('tipo_evento', '');
        $evento_id = $request->get('evento', '');

        $eventos = [];
        if ($tipo_evento) {
            $eventos = Servico::where('cod_tipo_servico', $tipo_evento)
                ->orderBy('data_inicio', 'desc')->get();
        }

        $servico = null;
        $funcionariosAssociados = [];
        $funcoesAssociadas = [];
        $kitsAssociados = [];

        // Carrega serviço e respetivos funcionários e kits já associados, se evento selecionado
        if ($evento_id) {
            $servico = Servico::with(['funcionarios.funcoes', 'kits'])->find($evento_id);

            $funcionariosAssociados = $servico ? $servico->funcionarios->pluck('cod_funcionario')->toArray() : [];
            // Preencher as funções previamente associadas (se já houver, por exemplo no check-in/edição)
            $funcoesAssociadas = $servico ? $servico->funcionarios->mapWithKeys(function($f) {
                // Exemplo: $f->pivot->cod_funcao
                return [$f->cod_funcionario => $f->pivot->cod_funcao ?? null];
            })->toArray() : [];

            $kitsAssociados = $servico ? $servico->kits->pluck('cod_kit')->toArray() : [];
        }

        // Carregar funcionários e as funções que cada um pode ter
        $funcionarios = Funcionario::with('funcoes')->orderBy('nome')->get();
        $kits = Kit::orderBy('nome_kit')->get();

        return view('servicos.checkout', [
            'tipos' => $tipos,
            'eventos' => $eventos,
            'servico' => $servico,
            'funcionarios' => $funcionarios,
            'kits' => $kits,
            'funcionariosAssociados' => $funcionariosAssociados,
            'funcoesAssociadas' => $funcoesAssociadas,
            'kitsAssociados' => $kitsAssociados,
            'evento_id' => $evento_id,
            'tipo_evento' => $tipo_evento,
        ]);
    }

    // GUARDAR CHECK-OUT
    public function storeCheckout(Request $request)
    {
        $evento_id = $request->input('evento');
        $servico = Servico::findOrFail($evento_id);

        // Associar KITS
        $kitsSelecionados = $request->input('kits', []);
        // O método 'kits()' tem de estar definido no model Servico!
        $servico->kits()->sync($kitsSelecionados);

        // Associar FUNCIONÁRIOS + FUNÇÃO
        $funcionariosSelecionados = $request->input('funcionarios', []);
        $funcoesSelecionadas = $request->input('funcoes', []);

        $dadosFuncionarios = [];
        foreach ($funcionariosSelecionados as $idx => $funcionarioId) {
            $dadosFuncionarios[$funcionarioId] = [
                'data_alocacao_inicio' => now(),
                'cod_funcao' => $funcoesSelecionadas[$idx] ?? null,
            ];
        }
        $servico->funcionarios()->sync($dadosFuncionarios);

        return redirect()->route('servicos.show', $evento_id)
            ->with('success', 'Check-out efetuado com sucesso!');
    }
}
