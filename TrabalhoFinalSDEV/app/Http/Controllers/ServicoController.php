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

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return response()->json($servicos);
    }

    /**
     * Store a newly created resource in storage.
     */
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
            // Criar cliente
            $cliente = Cliente::create([
                'nome' => $validated['nome_cliente'],
                'email' => $validated['email_cliente'] ?? null,
                'telefone' => $validated['telefone_cliente'] ?? null,
            ]);

            // Criar serviço
            $servico = Servico::create([
                'cod_cliente' => $cliente->cod_cliente,
                'cod_tipo_servico' => $validated['cod_tipo_servico'],
                'cod_local_servico' => $validated['cod_local_servico'],
                'data_inicio' => $validated['data_inicio'],
                'data_fim' => $validated['data_fim'],
                'nome_servico' => $validated['nome_servico'],
            ]);

            // Criar detalhes específicos com base no tipo
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

            return response()->json(['message' => 'Serviço criado com sucesso', 'servico' => $servico], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao criar serviço'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
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

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        return response()->json($servico);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $servico = Servico::find($id);

        if (!$servico) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
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
            return response()->json(['message' => 'Serviço atualizado com sucesso']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao atualizar serviço'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
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
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        DB::beginTransaction();

        try {
            // Eliminar detalhes conforme o tipo de serviço
            if ($servico->detalhesBatizado) {
                $servico->detalhesBatizado->delete();
            } elseif ($servico->detalhesCasamento) {
                $servico->detalhesCasamento->delete();
            } elseif ($servico->detalhesComunhaoGeral) {
                $servico->detalhesComunhaoGeral->delete();
            } elseif ($servico->detalhesComunhaoParticular) {
                $servico->detalhesComunhaoParticular->delete();
            } elseif ($servico->detalhesEvCorporativo) {
                $servico->detalhesEvCorporativo->delete();
            }

            $servico->delete();

            DB::commit();
            return response()->json(['message' => 'Serviço apagado com sucesso']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao apagar serviço'], 500);
        }
    }
}
