<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\TiposServico;
use App\Models\Funcionario;
use App\Models\Material;

class ServicoCheckinController extends Controller
{
    // FORMULÁRIO DE CHECK-OUT (levantamento do material)
    public function formCheckout(Request $request)
    {
        $tipos = TiposServico::all();

        // Sempre carrega todos os eventos (filtra em JS)
        $eventos = Servico::orderBy('data_inicio', 'desc')->get();

        $tipo_evento = $request->get('tipo_evento', '');
        $evento_id = $request->get('evento', '');

        // Só mostra eventos do tipo escolhido
        $eventos = [];
        if ($tipo_evento) {
            $eventos = Servico::where('cod_tipo_servico', $tipo_evento)
                ->orderBy('data_inicio', 'desc')->get();
        }

        $servico = null;
        $materiaisAssociados = [];
        $funcionariosAssociados = [];

        // Carrega serviço e respetivos materiais/funcionários já associados, se evento selecionado
        if ($evento_id) {
            $servico = Servico::with(['funcionarios', 'materiais'])->find($evento_id);

            $materiaisAssociados = $servico ? $servico->materiais->pluck('cod_material')->toArray() : [];
            $funcionariosAssociados = $servico ? $servico->funcionarios->pluck('cod_funcionario')->toArray() : [];
        }

        // Todos para seleção
        $materiais = Material::all();
        $funcionarios = Funcionario::all();

        return view('servicos.checkout', [
            'tipos' => $tipos,
            'eventos' => $eventos,
            'servico' => $servico,
            'materiais' => $materiais,
            'funcionarios' => $funcionarios,
            'materiaisAssociados' => $materiaisAssociados,
            'funcionariosAssociados' => $funcionariosAssociados,
            'evento_id' => $evento_id,
            'tipo_evento' => $tipo_evento,
        ]);
    }

    // GUARDAR CHECK-OUT
    public function storeCheckout(Request $request)
    {
        $evento_id = $request->input('evento');
        $servico = Servico::findOrFail($evento_id);

        // Materiais selecionados
        $materiaisSelecionados = $request->input('materiais', []);
        $dadosMateriais = [];
        foreach ($materiaisSelecionados as $materialId) {
            $dadosMateriais[$materialId] = [
                'data_levantamento' => now(),
            ];
        }
        $servico->materiais()->sync($dadosMateriais);

        // Funcionários selecionados
        $funcionariosSelecionados = $request->input('funcionarios', []);
        $dadosFuncionarios = [];
        foreach ($funcionariosSelecionados as $funcionarioId) {
            $dadosFuncionarios[$funcionarioId] = [
                'data_alocacao_inicio' => now(),
            ];
        }
        $servico->funcionarios()->sync($dadosFuncionarios);

        return redirect()->route('servicos.show', $evento_id)
            ->with('success', 'Check-out efetuado com sucesso!');
    }
}
