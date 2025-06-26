<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Servico;
use App\Models\Cliente;
use App\Models\ServicoDetalhesBatizado;
use App\Models\ServicoDetalhesCasamento;
use App\Models\ServicoDetalhesComunhaoGeral;
use App\Models\ServicoDetalhesComunhaoParticular;
use App\Models\ServicoDetalhesEvCorporativo;
use App\Models\TiposServico;
use App\Models\Localizacao;
use App\Http\Requests\StoreUpdateServicoRequest;

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
    public function store(StoreUpdateServicoRequest $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validated();

            // Cria Cliente (apenas no store)
            Log::debug('A criar cliente', $validated);
            $cliente = Cliente::create([
                'nome' => $validated['nome_cliente'],
                'mail' => $validated['email_cliente'] ?? null,
                'telefone' => $validated['telefone_cliente'] ?? null,
            ]);
            Log::debug('Cliente criado', ['cliente' => $cliente->toArray()]);

            $servico = Servico::create([
                'cod_cliente' => $cliente->cod_cliente,
                'cod_tipo_servico' => $validated['cod_tipo_servico'],
                'cod_local_servico' => $validated['cod_local_servico'],
                'data_inicio' => $validated['data_inicio'],
                'data_fim' => $validated['data_fim'],
                'nome_servico' => $validated['nome_servico'],
            ]);
            Log::debug('Serviço criado', ['servico' => $servico->toArray()]);

            $tipo = (int) $validated['cod_tipo_servico'];
            $detalhes = $request->input('detalhes', []);

            Log::debug('A criar detalhes', [
                'tipo' => $tipo,
                'detalhes' => $detalhes
            ]);

            // Filtragem dos detalhes para gravar só os campos do modelo correto
            $model = null;
            switch ($tipo) {
                case 1:
                    $model = new ServicoDetalhesCasamento();
                    break;
                case 2:
                    $model = new ServicoDetalhesBatizado();
                    break;
                case 3:
                    $model = new ServicoDetalhesEvCorporativo();
                    break;
                case 4:
                    $model = new ServicoDetalhesComunhaoParticular();
                    break;
                case 5:
                    $model = new ServicoDetalhesComunhaoGeral();
                    break;
            }
            if ($model) {
                $fillable = $model->getFillable();
                $detalhes_filtrados = array_intersect_key($detalhes, array_flip($fillable));

                // Preenche campos boolean a 0 se não enviados
                $camposBooleanos = [
                    'fotos',
                    'video',
                    'drone',
                    'sde',
                    'fotos_convidados',
                    'venda_fotos',
                    'coro',
                    'grupo_exterior',
                    'oferta_ramo',
                    'diplomas'
                ];
                foreach ($camposBooleanos as $campo) {
                    if (in_array($campo, $fillable) && !isset($detalhes_filtrados[$campo])) {
                        $detalhes_filtrados[$campo] = 0;
                    }
                }
                // Log para confirmar antes de criar
                Log::debug('A inserir detalhes', [
                    'tabela' => $model->getTable(),
                    'data' => array_merge($detalhes_filtrados, ['cod_servico' => $servico->cod_servico])
                ]);
                $model::create(array_merge($detalhes_filtrados, [
                    'cod_servico' => $servico->cod_servico
                ]));
                Log::debug('Detalhes criados');
            } else {
                Log::warning('Tipo de serviço inválido ou não encontrado', ['tipo' => $tipo]);
            }

            DB::commit();
            Log::debug('Commit realizado com sucesso!');
            return redirect()->route('servicos.home')->with('success', 'Serviço criado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao criar serviço', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['error' => 'Erro ao criar serviço: ' . $e->getMessage()]);
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
            if (!$alocado) {
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

        $validated = $request->validated();

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

    public function home()
    {

        return view('servicos.home');
    }
}
