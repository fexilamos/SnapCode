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
use Illuminate\Support\Facades\Log;

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
        $kitsDoEventoAtual = $kitsAssociados;
        $kitsIndisponiveisIds = DB::table('servico_kit')
            ->whereNull('data_devolucao')
            ->when($evento_id, function ($q) use ($evento_id) {
                $q->where('cod_servico', '!=', $evento_id);
            })
            ->pluck('cod_kit')
            ->toArray();

        $kits = Kit::whereNotIn('cod_kit', $kitsIndisponiveisIds)
            ->orWhereIn('cod_kit', $kitsDoEventoAtual)
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
        $kitsSelecionados = array_unique(array_filter($request->input('kits', []), fn($k) => is_numeric($k) && !is_array($k)));
        if (empty($kitsSelecionados)) {
            return back()->withErrors(['É obrigatório selecionar pelo menos um kit.']);
        }

        // Validação de disponibilidade dos kits...
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
            $dadosKits[$kitId] = [
                'data_levantamento' => now(),
            ];
        }
        $servico->kits()->sync($dadosKits);

        // --- FUNCIONÁRIOS + FUNÇÕES ---
        $funcionariosSelecionados = $request->input('funcionarios', []);
        $funcoesSelecionadas = array_values($request->input('funcoes', []));
        $dadosFuncionarios = [];
        foreach ($funcionariosSelecionados as $idx => $funcionarioId) {
            if (is_array($funcionarioId) || !is_numeric($funcionarioId)) {
                Log::error('FuncionarioId inválido', ['idx' => $idx, 'valor' => $funcionarioId]);
                continue;
            }
            $dadosFuncionarios[(int)$funcionarioId] = [
                'data_alocacao_inicio' => now(),
                'funcao_no_servico' => $funcoesSelecionadas[$idx] ?? null,
            ];
        }
        Log::debug('dadosFuncionarios para sync', $dadosFuncionarios);
        if (empty($dadosFuncionarios)) {
            return back()->withErrors(['Erro: Nenhum funcionário válido selecionado!']);
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
            $query->where(function ($q) use ($search) {
                $q->where('nome_servico', 'like', "%$search%")
                    ->orWhereHas('funcionarios', function ($subq) use ($search) {
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

    public function editCheckout($servicoId)
    {
        $servico = Servico::with(['funcionarios.funcoes', 'kits'])->findOrFail($servicoId);

        $tipos = TiposServico::all();
        $funcionarios = Funcionario::with('funcoes')->orderBy('nome')->get();
        $kits = Kit::orderBy('nome_kit')->get();
        $funcoes = Funcao::all();

        // Associações já existentes para preencher o formulário
        $funcionariosAssociados = $servico->funcionarios->pluck('cod_funcionario')->toArray();
        $funcoesAssociadas = $servico->funcionarios->mapWithKeys(function ($f) {
            return [$f->cod_funcionario => $f->pivot->funcao_no_servico ?? null];
        })->toArray();
        $kitsAssociados = $servico->kits->pluck('cod_kit')->toArray();

        return view('servicos.checkout.edit', [
            'servico' => $servico,
            'tipos' => $tipos,
            'funcionarios' => $funcionarios,
            'kits' => $kits,
            'funcoes' => $funcoes,
            'funcionariosAssociados' => $funcionariosAssociados,
            'funcoesAssociadas' => $funcoesAssociadas,
            'kitsAssociados' => $kitsAssociados,
        ]);
    }

    public function updateCheckout(Request $request, $servicoId)
    {
        $servico = Servico::findOrFail($servicoId);

        $request->validate([
            'funcionarios' => 'required|array|min:1',
            'funcoes' => 'required|array|min:1',
            'kits' => 'required|array|min:1',
        ]);

        // --- KITS ---
        $kitsSelecionados = array_unique(array_filter($request->input('kits', []), fn($k) => is_numeric($k) && !is_array($k)));
        $dadosKits = [];
        foreach ($kitsSelecionados as $kitId) {
            $dadosKits[$kitId] = [
                'data_levantamento' => now(),
            ];
        }
        $servico->kits()->sync($dadosKits);

        // --- FUNCIONÁRIOS + FUNÇÕES ---
        $funcionariosSelecionados = $request->input('funcionarios', []);
        $funcoesSelecionadas = array_values($request->input('funcoes', []));
        $dadosFuncionarios = [];
        foreach ($funcionariosSelecionados as $idx => $funcionarioId) {
            if (is_array($funcionarioId) || !is_numeric($funcionarioId)) {
                Log::error('FuncionarioId inválido', ['idx' => $idx, 'valor' => $funcionarioId]);
                continue;
            }
            $dadosFuncionarios[(int)$funcionarioId] = [
                'data_alocacao_inicio' => now(),
                'funcao_no_servico' => $funcoesSelecionadas[$idx] ?? null,
            ];
        }
        Log::debug('dadosFuncionarios para sync', $dadosFuncionarios);
        if (empty($dadosFuncionarios)) {
            return back()->withErrors(['Erro: Nenhum funcionário válido selecionado!']);
        }
        $servico->funcionarios()->sync($dadosFuncionarios);

        return redirect()->route('servicos.checkout.index')
            ->with('success', 'Check-out atualizado com sucesso!');
    }

    // Elimina TODAS as associações de kits e funcionários ao serviço
    public function destroyCheckout($servicoId)
    {
        $servico = Servico::findOrFail($servicoId);

        $servico->kits()->detach();
        $servico->funcionarios()->detach();

        return redirect()->route('servicos.checkout.index')->with('success', 'Check-out eliminado com sucesso!');
    }

    public function homeCheckin()
    {
        return view('servicos.checkin.home');
    }
    public function selecionarServicoParaCheckin()
    {
        $servicos = Servico::whereHas('kits', function ($q) {
            $q->whereNull('servico_kit.data_devolucao');
        })->get();

        return view('servicos.checkin.selecao', [
            'servicos' => $servicos,
        ]);
    }
    public function createCheckin($servicoId)
    {
         // Carrega os kits e funcionarios associados ao serviço
    $servico = Servico::with(['kits.materiais', 'funcionarios'])->findOrFail($servicoId);

    // Filtra só os kits que ainda não foram devolvidos
    $kitsNaoDevolvidos = $servico->kits->filter(function ($kit) {
        return is_null($kit->pivot->data_devolucao);
    });

    $funcionarios = $servico->funcionarios;

    return view('servicos.checkin.create', [
        'servico' => $servico,
        'kitsNaoDevolvidos' => $kitsNaoDevolvidos,
        'funcionarios' => $funcionarios,
    ]);
    }

    public function updateCheckin(Request $request, $servicoId)
{
    $kitsDevolvidos = $request->input('kits_devolvidos', []);
    foreach ($kitsDevolvidos as $kitId) {
        DB::table('servico_kit')
            ->where('cod_servico', $servicoId)
            ->where('cod_kit', $kitId)
            ->update(['data_devolucao' => now()]);
    }

    return redirect()->route('servicos.checkin.index', $servicoId)
        ->with('success', 'Kits devolvidos com sucesso!');
}

}
