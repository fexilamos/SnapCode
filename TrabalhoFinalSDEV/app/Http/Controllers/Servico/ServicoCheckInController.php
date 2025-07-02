<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\TiposServico;
use App\Models\Funcionario;
use App\Models\Kit;
use App\Models\Funcao;
use App\Models\ServicoEquipamento;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class ServicoCheckInController extends Controller
{

    public function home()
    {
        return view('servicos.checkout.home');
    }
    // FORMULÁRIO DE CHECK-OUT
    public function formCheckout(Request $request)
    {
        $tipos = TiposServico::all();

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

        if ($evento_id) {
            $servico = Servico::with(['funcionarios.funcoes', 'kits'])->find($evento_id);

            $funcionariosAssociados = $servico ? $servico->funcionarios->pluck('cod_funcionario')->toArray() : [];
            $funcoesAssociadas = $servico ? $servico->funcionarios->mapWithKeys(function ($f) {
                return [$f->cod_funcionario => $f->pivot->cod_funcao ?? null];
            })->toArray() : [];

            $kitsAssociados = $servico ? $servico->kits->pluck('cod_kit')->toArray() : [];
        }

        $funcionarios = Funcionario::with('funcoes')->orderBy('nome')->get();
        $kits = Kit::orderBy('nome_kit')->get();
        $funcoes = Funcao::all();

        return view('servicos.checkout.create', [
            'tipos' => $tipos,
            'eventos' => $eventos,
            'servico' => $servico,
            'funcionarios' => $funcionarios,
            'kits' => $kits,
            'funcoes' => $funcoes,
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

        // KITS
        $kitsSelecionados = $request->input('kits', []);
        $servico->kits()->sync($kitsSelecionados);

        // FUNCIONÁRIOS + FUNÇÕES
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

        return redirect()->route('servicos.checkout.index', $evento_id)
            ->with('success', 'Check-out efetuado com sucesso!');
    }
   public function index(Request $request)
    {
        // Começa o query builder com relações
        $query = ServicoEquipamento::with(['servico.cliente', 'material'])
            ->whereNotNull('data_levantamento')
            ->orderByDesc('data_levantamento');

        // Filtro por código do serviço
        if ($request->filled('servico')) {
            $query->where('cod_servico', $request->input('servico'));
        }

        // Filtro por material
        if ($request->filled('material')) {
            $query->where('cod_material', $request->input('material'));
        }

        // Filtro por data
        if ($request->filled('data')) {
            $query->whereDate('data_levantamento', $request->input('data'));
        }

        $checkouts = $query->get();

        $servicos = Servico::orderBy('nome_servico')->get();
        $materiais = Material::orderBy('cod_material')->get();

        return view('servicos.checkout.index', [
            'checkouts' => $checkouts,
            'servicos' => $servicos,
            'materiais' => $materiais,
        ]);
    }
}
