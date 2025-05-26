<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Servico;
use App\Models\Cliente;
use App\Models\ServicoDetalhesBatizado;
use App\Models\ServicoDetalhesCasamento;
use App\Models\ServicoDetalhesComunhaoGeral;
use App\Models\ServicoDetalhesComunhaoParticular;
use App\Models\ServicoDetalhesEvCorporativo;
use App\Models\TiposServico;
use App\Models\Localizacao;

class ServicoController extends Controller
{
    // Listar serviços
    public function index()
    {
        $servicos = Servico::with([
            'cliente',
            'tipoServico',
            'localizacao',
            'detalhesBatizado',
            'detalhesCasamento',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEvCorporativo'
        ])->get();

        return view('servicos.index', compact('servicos'));
    }

    // Formulário para criar serviço
    public function create()
    {
        $tipos = TiposServico::all();
        $localizacoes = Localizacao::all();
        return view('servicos.create', compact('tipos', 'localizacoes'));
    }

    // Guardar novo serviço
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Cliente
            'nome_cliente' => 'required|string|max:255',
            'email_cliente' => 'nullable|email',
            'telefone_cliente' => 'nullable|string|max:20',
            // Serviço
            'cod_tipo_servico' => 'required|exists:TiposServico,cod_tipo_servico',
            'cod_local_servico' => 'required|exists:Localizacao,cod_local_servico',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'nome_servico' => 'required|string|max:255',
            // Detalhes (opcionais, dependendo do tipo)
            'detalhes' => 'nullable|array'
        ]);

        DB::beginTransaction();

        try {
            $cliente = Cliente::create([
                'nome' => $validated['nome_cliente'],
                'email' => $validated['email_cliente'] ?? null,
                'telefone' => $validated['telefone_cliente'] ?? null,
            ]);

            $servico = Servico::create([
                'cod_cliente' => $cliente->cod_cliente,
                'cod_tipo_servico' => $validated['cod_tipo_servico'],
                'cod_local_servico' => $validated['cod_local_servico'],
                'data_inicio' => $validated['data_inicio'],
                'data_fim' => $validated['data_fim'],
                'nome_servico' => $validated['nome_servico'],
            ]);

            $tipo = (int) $validated['cod_tipo_servico'];
            $detalhes = $validated['detalhes'] ?? [];

            switch ($tipo) {
                case 1: // Batizado
                    ServicoDetalhesBatizado::create(array_merge($detalhes, ['cod_servico' => $servico->cod_servico]));
                    break;
                case 2: // Casamento
                    ServicoDetalhesCasamento::create(array_merge($detalhes, ['cod_servico' => $servico->cod_servico]));
                    break;
                case 3: // Comunhão Geral
                    ServicoDetalhesComunhaoGeral::create(array_merge($detalhes, ['cod_servico' => $servico->cod_servico]));
                    break;
                case 4: // Comunhão Particular
                    ServicoDetalhesComunhaoParticular::create(array_merge($detalhes, ['cod_servico' => $servico->cod_servico]));
                    break;
                case 5: // Evento Corporativo
                    ServicoDetalhesEvCorporativo::create(array_merge($detalhes, ['cod_servico' => $servico->cod_servico]));
                    break;
            }

            DB::commit();

            return redirect()->route('servicos.index')->with('success', 'Serviço criado com sucesso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar serviço.']);
        }
    }

    // Ver detalhes de um serviço
    public function show(string $id)
    {
        $servico = Servico::with([
            'cliente',
            'tipoServico',
            'localizacao',
            'detalhesBatizado',
            'detalhesCasamento',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEvCorporativo'
        ])->find($id);

        $user = auth()->user();

        if ($user->funcionario->cod_nivel == 3) {
            $alocado = $servico->funcionarios->contains('cod_funcionario', $user->funcionario->cod_funcionario);
                if (!$alocado)
                {
                    abort(403, 'Acesso não autorizado!');
                }
        }
        if (!$servico) {
            return redirect()->route('servicos.index')->with('error', 'Serviço não encontrado.');
        }

        return view('servicos.show', compact('servico'));
    }

    // Formulário de edição de serviço
    public function edit($id)
    {
        $servico = Servico::with([
            'cliente',
            'tipoServico',
            'localizacao',
            'detalhesBatizado',
            'detalhesCasamento',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEvCorporativo'
        ])->find($id);

        if (!$servico) {
            return redirect()->route('servicos.index')->with('error', 'Serviço não encontrado.');
        }

        $tipos = TiposServico::all();
        $localizacoes = Localizacao::all();

        return view('servicos.edit', compact('servico', 'tipos', 'localizacoes'));
    }

    // Atualizar serviço
    public function update(Request $request, string $id)
    {
        $servico = Servico::with([
            'detalhesBatizado',
            'detalhesCasamento',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEvCorporativo'
        ])->find($id);

        if (!$servico) {
            return redirect()->route('servicos.index')->with('error', 'Serviço não encontrado.');
        }

        $validated = $request->validate([
            'cod_tipo_servico' => 'required|exists:TiposServico,cod_tipo_servico',
            'cod_local_servico' => 'required|exists:Localizacao,cod_local_servico',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'nome_servico' => 'required|string|max:255',
            'detalhes' => 'nullable|array'
        ]);

        DB::beginTransaction();

        try {
            $servico->update([
                'cod_tipo_servico' => $validated['cod_tipo_servico'],
                'cod_local_servico' => $validated['cod_local_servico'],
                'data_inicio' => $validated['data_inicio'],
                'data_fim' => $validated['data_fim'],
                'nome_servico' => $validated['nome_servico'],
            ]);

            $tipo = (int) $validated['cod_tipo_servico'];
            $detalhes = $validated['detalhes'] ?? [];

            switch ($tipo) {
                case 1:
                    $servico->detalhesBatizado()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhes
                    );
                    break;
                case 2:
                    $servico->detalhesCasamento()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhes
                    );
                    break;
                case 3:
                    $servico->detalhesComunhaoGeral()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhes
                    );
                    break;
                case 4:
                    $servico->detalhesComunhaoParticular()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhes
                    );
                    break;
                case 5:
                    $servico->detalhesEvCorporativo()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhes
                    );
                    break;
            }

            DB::commit();
            return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao atualizar serviço.']);
        }
    }

    // Apagar serviço
    public function destroy(string $id)
    {
        $servico = Servico::with([
            'detalhesBatizado',
            'detalhesCasamento',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEvCorporativo'
        ])->find($id);

        if (!$servico) {
            return redirect()->route('servicos.index')->with('error', 'Serviço não encontrado.');
        }

        DB::beginTransaction();

        try {
            // Apagar todos os detalhes associados (caso existam)
            if ($servico->detalhesBatizado) {
                $servico->detalhesBatizado->delete();
            }
            if ($servico->detalhesCasamento) {
                $servico->detalhesCasamento->delete();
            }
            if ($servico->detalhesComunhaoGeral) {
                $servico->detalhesComunhaoGeral->delete();
            }
            if ($servico->detalhesComunhaoParticular) {
                $servico->detalhesComunhaoParticular->delete();
            }
            if ($servico->detalhesEvCorporativo) {
                $servico->detalhesEvCorporativo->delete();
            }

            $servico->delete();

            DB::commit();
            return redirect()->route('servicos.index')->with('success', 'Serviço apagado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao apagar serviço.']);
        }
    }
}
