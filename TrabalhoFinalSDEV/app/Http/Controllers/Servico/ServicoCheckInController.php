<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\TiposServico;
use App\Models\Funcionario;
use App\Models\Kit;
use App\Models\Funcao;
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
                return [$f->cod_funcionario => $f->pivot->funcao_no_servico ?? null];
            })->toArray() : [];

            $kitsAssociados = $servico ? $servico->kits->pluck('cod_kit')->toArray() : [];
        }

        // --- FILTRAR KITS DISPONÍVEIS ---
        // Apenas permite selecionar kits que NÃO estão noutros eventos SEM data_devolucao (ou então que já estão associados a este serviço)
        $kitsDoEventoAtual = $kitsAssociados;
        $kitsIndisponiveisIds = DB::table('servico_kit')
            ->whereNull('data_devolucao')
            ->when($evento_id, function ($q) use ($evento_id) {
                $q->where('cod_servico', '!=', $evento_id);
            })
            ->pluck('cod_kit')
            ->toArray();

        $kits = Kit::whereNotIn('cod_kit', $kitsIndisponiveisIds)
            ->orWhereIn('cod_kit', $kitsDoEventoAtual) // inclui os já associados a este evento
            ->orderBy('nome_kit')
            ->get();

        $funcionarios = Funcionario::with('funcoes')->orderBy('nome')->get();
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
        if (!$evento_id) {
            return back()->withErrors(['O evento não foi selecionado!']);
        }

        $servico = Servico::find($evento_id);
        if (!$servico) {
            return back()->withErrors(['O evento selecionado não existe!']);
        }

        // --- KITS ---
        $kitsSelecionados = array_unique(array_filter($request->input('kits', []), fn($k) => $k && is_numeric($k)));
        if (empty($kitsSelecionados)) {
            return back()->withErrors(['É obrigatório selecionar pelo menos um kit.']);
        }

        // --- VALIDAÇÃO DE DISPONIBILIDADE ---
        foreach ($kitsSelecionados as $kitId) {
            $kitEmUso = DB::table('servico_kit')
                ->where('cod_kit', $kitId)
                ->whereNull('data_devolucao')
                ->where('cod_servico', '!=', $servico->cod_servico)
                ->exists();

            if ($kitEmUso) {
                return back()->withErrors(['O kit "' . $kitId . '" já está associado a outro evento!']);
            }
        }

        $dadosKits = [];
        foreach ($kitsSelecionados as $kitId) {
            $kitId = (string)$kitId;
            $dadosKits[$kitId] = [
                'data_levantamento' => now(),
            ];
        }
        $servico->kits()->sync($dadosKits);

        // --- FUNCIONÁRIOS + FUNÇÕES ---
        $funcionariosSelecionados = $request->input('funcionarios', []);
        $funcoesSelecionadas = $request->input('funcoes', []);
        if (empty($funcionariosSelecionados)) {
            return back()->withErrors(['É obrigatório selecionar pelo menos um funcionário.']);
        }

        $dadosFuncionarios = [];
        foreach ($funcionariosSelecionados as $idx => $funcionarioId) {
            $dadosFuncionarios[$funcionarioId] = [
                'data_alocacao_inicio' => now(),
                'funcao_no_servico' => $funcoesSelecionadas[$idx] ?? null,
            ];
        }
        $servico->funcionarios()->sync($dadosFuncionarios);

        return redirect()->route('servicos.checkout.index')
            ->with('success', 'Check-out efetuado com sucesso!');
    }


    // LISTA DE CHECK-OUTS
    public function index(Request $request)
{
    $query = Servico::with(['kits', 'funcionarios']);
    $query->whereHas('kits');

    // Filtro pesquisa geral: nome do evento OU nome de funcionário
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('nome_servico', 'like', "%$search%")
              ->orWhereHas('funcionarios', function($subq) use ($search) {
                  $subq->where('nome', 'like', "%$search%");
              });
        });
    }

    // Filtro por data de levantamento
    if ($request->filled('data')) {
        $data = $request->input('data');
        $query->whereHas('kits', function ($q) use ($data) {
            $q->whereDate('servico_kit.data_levantamento', $data);
        });
    }

    $checkouts = $query->orderBy('data_inicio', 'desc')->get();

    return view('servicos.checkout.index', [
        'checkouts' => $checkouts,
    ]);
}

    public function formCheckin($servicoId)
    {
        $servico = Servico::with('kits')->findOrFail($servicoId);

        $kitsNaoDevolvidos = $servico->kits->filter(function ($kit) {
            return is_null($kit->pivot->data_devolucao);
        });

        return view('servicos.checkout.checkin', [
            'servico' => $servico,
            'kitsNaoDevolvidos' => $kitsNaoDevolvidos,
        ]);
    }

    public function checkin(Request $request, $servicoId)
    {
        $servico = Servico::findOrFail($servicoId);

        $kitsADevolver = $request->input('kits', []);

        foreach ($kitsADevolver as $kitId) {
            $servico->kits()->updateExistingPivot($kitId, [
                'data_devolucao' => now(),
            ]);
        }

        return redirect()->route('servicos.checkout.index')
            ->with('success', 'Devolução de kit(s) efetuada com sucesso!');
    }
}
