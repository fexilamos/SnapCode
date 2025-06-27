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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
            // Mapeamento explícito para evitar erros de ordem
            // 1: Casamento, 2: Batizado, 3: Comunhão Geral, 4: Comunhão Particular, 5: Corporativo
            switch ($tipo) {
                case 1: // Casamento
                    $model = new ServicoDetalhesCasamento();
                    break;
                case 2: // Batizado
                    $model = new ServicoDetalhesBatizado();
                    break;
                case 3: // Comunhão Geral
                    $model = new ServicoDetalhesComunhaoGeral();
                    break;
                case 4: // Comunhão Particular
                    $model = new ServicoDetalhesComunhaoParticular();
                    break;
                case 5: // Corporativo
                    $model = new ServicoDetalhesEvCorporativo();
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
        $user = Auth::user();


        if ($user->funcionario->cod_nivel == 3) {
            $alocado = $servico->funcionarios->contains('cod_funcionario', $user->funcionario->cod_funcionario);
            if (!$alocado) {
                abort(403, 'Acesso não autorizado!');
            }
        }
        if (!$servico) {
            return redirect()->route('servicos.index')->with('error', 'Serviço não encontrado.');
        }

        // NOVO MAPEAMENTO PARA O SLUG
        $tipoSlugMap = [
            1 => 'casamento',
            2 => 'batizado',
            3 => 'corporativo',
            4 => 'comunhao_particular',
            5 => 'comunhao_geral'
        ];
        $tipo = $tipoSlugMap[$servico->cod_tipo_servico] ?? null;

        return view('servicos.show', compact('servico', 'tipo'));
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
    public function update(StoreUpdateServicoRequest $request, string $id)
    {
        $servico = Servico::with([
            'detalhesCasamento',
            'detalhesBatizado',
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
            // Atualiza dados principais do serviço
            $servico->update([
                'cod_tipo_servico' => $validated['cod_tipo_servico'],
                'cod_local_servico' => $validated['cod_local_servico'],
                'data_inicio' => $validated['data_inicio'],
                'data_fim' => $validated['data_fim'],
                'nome_servico' => $validated['nome_servico'],
            ]);

            if ($servico->cliente) {
                $servico->cliente->update([
                    'nome' => $validated['nome_cliente'],
                    'mail' => $validated['email_cliente'],
                    'telefone' => $validated['telefone_cliente'],
                ]);
            }

            $tipo = (int) $validated['cod_tipo_servico'];
            $detalhesForm = $validated['detalhes'] ?? [];

            Log::debug('DETALHES RECEBIDOS:', $detalhesForm);

            switch ($tipo) {
                case 1: // Casamento
                    $model = new ServicoDetalhesCasamento();
                    $detalhesAntigos = $servico->detalhesCasamento ? $servico->detalhesCasamento->toArray() : [];
                    $fillable = $model->getFillable();
                    $detalhesCompletos = $this->mergeDetalhes($detalhesForm, $detalhesAntigos, $fillable);
                    $servico->detalhesCasamento()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhesCompletos
                    );
                    break;
                case 2: // Batizado
                    $model = new ServicoDetalhesBatizado();
                    $detalhesAntigos = $servico->detalhesBatizado ? $servico->detalhesBatizado->toArray() : [];
                    $fillable = $model->getFillable();
                    $detalhesCompletos = $this->mergeDetalhes($detalhesForm, $detalhesAntigos, $fillable);
                    $servico->detalhesBatizado()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhesCompletos
                    );
                    break;
                case 3: // Comunhão Geral
                    $model = new ServicoDetalhesComunhaoGeral();
                    $detalhesAntigos = $servico->detalhesComunhaoGeral ? $servico->detalhesComunhaoGeral->toArray() : [];
                    $fillable = $model->getFillable();
                    $detalhesCompletos = $this->mergeDetalhes($detalhesForm, $detalhesAntigos, $fillable);
                    $servico->detalhesComunhaoGeral()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhesCompletos
                    );
                    break;
                case 4: // Comunhão Particular
                    $model = new ServicoDetalhesComunhaoParticular();
                    $detalhesAntigos = $servico->detalhesComunhaoParticular ? $servico->detalhesComunhaoParticular->toArray() : [];
                    $fillable = $model->getFillable();
                    $detalhesCompletos = $this->mergeDetalhes($detalhesForm, $detalhesAntigos, $fillable);
                    $servico->detalhesComunhaoParticular()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhesCompletos
                    );
                    break;
                case 5: // Corporativo
                    $model = new ServicoDetalhesEvCorporativo();
                    $detalhesAntigos = $servico->detalhesEvCorporativo ? $servico->detalhesEvCorporativo->toArray() : [];
                    $fillable = $model->getFillable();
                    $detalhesCompletos = $this->mergeDetalhes($detalhesForm, $detalhesAntigos, $fillable);
                    $servico->detalhesEvCorporativo()->updateOrCreate(
                        ['cod_servico' => $servico->cod_servico],
                        $detalhesCompletos
                    );
                    break;
            }

            DB::commit();
            return redirect()->route('servicos.show', [$servico->cod_servico])->with('success', 'Serviço atualizado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao atualizar serviço: ' . $e->getMessage()]);
        }
    }


    public function home()
    {

        return view('servicos.home');
    }


    // Listar eventos por tipo
    public function listarPorTipo($tipo)
    {
        $tiposMap = [
            'casamento' => 1,
            'batizado' => 2,
            'corporativo' => 3,
            'comunhao_particular' => 4,
            'comunhao_geral' => 5,
        ];
        if (!isset($tiposMap[$tipo])) {
            abort(404);
        }
        $query = Servico::with([
            'cliente',
            'tipoServico',
            'localizacao',
            'detalhesBatizado',
            'detalhesCasamento',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEvCorporativo'
        ])->where('cod_tipo_servico', $tiposMap[$tipo]);

        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('nome_servico', 'like', "%$search%")
                  ->orWhereHas('cliente', function($q2) use ($search) {
                      $q2->where('nome', 'like', "%$search%");
                  })
                  ->orWhereHas('localizacao', function($q3) use ($search) {
                      $q3->where('nome_local', 'like', "%$search%");
                  });
            });
        }

        $servicos = $query->orderBy('data_inicio', 'desc')->get();
        return view('servicos.lista-tipo', compact('servicos', 'tipo'));
    }

    public function exportPdf($id)
    {
        $servico = Servico::with([
            'cliente',
            'tipoServico',
            'localizacao',
            'detalhesCasamento',
            'detalhesBatizado',
            'detalhesComunhaoGeral',
            'detalhesComunhaoParticular',
            'detalhesEVCorporativo'
        ])->findOrFail($id);

        $dados = \App\Models\PDF::dadosServico($servico);

        $pdf = Pdf::loadView('servicos.pdf', [
            'servico' => $servico,
            'dados' => $dados
        ]);
        return $pdf->download('servico_' . $servico->cod_servico . '.pdf');
    }
    private function mergeDetalhes($form, $old, $fillable)
    {
        $resultado = [];
        foreach ($fillable as $campo) {
            if ($campo === 'cod_servico') continue;
            if (array_key_exists($campo, $form)) {
                $resultado[$campo] = $form[$campo];
            } elseif (array_key_exists($campo, $old)) {
                $resultado[$campo] = $old[$campo];
            } else {
                // valor por defeito para booleanos, null para outros
                $resultado[$campo] = in_array($campo, [
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
                ]) ? 0 : null;
            }
        }
        return $resultado;
    }
}
