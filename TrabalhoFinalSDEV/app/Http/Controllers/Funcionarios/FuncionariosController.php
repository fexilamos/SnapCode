<?php

namespace App\Http\Controllers\Funcionarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Funcionario;
use App\Models\Funcao;
use App\Models\FuncionarioEstado;
use App\Models\Nivel;
use App\Http\Requests\StoreUpdateFuncionarioRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    // Listar funcionários
    public function index(Request $request)
    {
        $query = Funcionario::with(['user', 'funcao', 'estado', 'nivel', 'funcoes']);

        // Filtro por função
        if ($request->filled('searchFunction')) {
            $query->where('cod_funcao', $request->input('searchFunction'));
        }

        $funcionarios = $query->paginate(10);
        return view('funcionarios.index', compact('funcionarios'));
    }

   public function home()
    {
        $funcionarios = Funcionario::with(['user', 'funcao', 'estado', 'nivel'])->get();
        return view('funcionarios.home', compact('funcionarios'));
    }


    // Formulário de criar novo funcionário
    public function create()
    {
        $funcoes = Funcao::all();
        $niveis = Nivel::all();
        return view('funcionarios.create', compact('funcoes', 'niveis'));
    }

    // Guardar novo funcionário
    public function store(StoreUpdateFuncionarioRequest $request)
    {
         DB::transaction(function () use ($request) {
            $funcoes = $request->input('funcoes');
            $cod_funcao = is_array($funcoes) && count($funcoes) > 0 ? $funcoes[0] : null;

            // Cria o funcionário
            $funcionario = Funcionario::create([
                'nome' => $request->input('nome'),
                'telefone' => $request->input('telemovel'),
                'mail' => $request->input('email'),
                'morada' => $request->input('morada'),
                'cod_nivel' => $request->input('cod_nivel'),
                'tem_equipamento_proprio' => $request->input('tem_equipamento_proprio'),
                'cod_funcao' => $cod_funcao,
                'cod_estado' => 1, // Estado padrão
            ]);

            // Relaciona funções (many-to-many)
            if ($funcoes) {
                $funcionario->funcoes()->sync($funcoes);
            }

            // Cria o user associado
            User::create([
                'name' => $request->input('nome'),
                'email' => $request->input('email'), // Corrigido de 'mail' para 'email'
                'password' => Hash::make($request->input('password')),
                'cod_funcionario' => $funcionario->cod_funcionario,
            ]);
        });
        return redirect()->route('funcionarios.index')->with('success', 'Colaborador registado com sucesso!');
    }

    // Mostrar um funcionário específico (detalhe)
    public function show($cod_funcionario)
    {
        $funcionario = Funcionario::with(['user', 'funcao', 'estado', 'nivel'])->find($cod_funcionario);

        if (!$funcionario) {
            return redirect()->route('funcionarios.index')->with('error', 'Funcionário não encontrado.');
        }

        return view('funcionarios.show', compact('funcionario'));
    }

    // Formulário de editar funcionário
    public function edit($cod_funcionario)
    {
        $funcionario = Funcionario::with(['user', 'funcao', 'estado', 'nivel'])->find($cod_funcionario);

        if (!$funcionario) {
            return redirect()->route('funcionarios.index')->with('error', 'Funcionário não encontrado.');
        }

        $funcoes = Funcao::all();
        $estados = FuncionarioEstado::all();
        $niveis = Nivel::all();

        return view('funcionarios.edit', compact('funcionario', 'funcoes', 'estados', 'niveis'));
    }

    // Atualizar funcionário
    public function update(StoreUpdateFuncionarioRequest $request, $cod_funcionario)
    {
        DB::transaction(function () use ($request, $cod_funcionario) {
            // Atualiza o funcionário
            $funcionario = Funcionario::findOrFail($cod_funcionario);
            $funcionario->update($request->only([
                'nome', 'email', 'nif', 'telemovel', 'cod_funcao', 'cod_estado', 'cod_nivel'
            ]));

            // Atualiza também o User associado, se existir
            $user = User::where('cod_funcionario', $funcionario->cod_funcionario)->first();
            if ($user) {
                $user->update([
                    'name' => $request->input('nome'),
                    'email' => $request->input('email'),
                ]);
            }
        });

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário e utilizador atualizados com sucesso!');
    }

    // Eliminar funcionário e user associado
    public function destroy($cod_funcionario)
    {
        $funcionario = Funcionario::with('user')->find($cod_funcionario);

        if (!$funcionario) {
            return redirect()->route('funcionarios.index')->with('error', 'Funcionário não encontrado.');
        }

        DB::beginTransaction();

        try {
            if ($funcionario->user) {
                $funcionario->user->delete();
            }

            $funcionario->delete();

            DB::commit();
            return redirect()->route('funcionarios.index')->with('success', 'Funcionário e utilizador apagados com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao eliminar funcionário.']);
        }
    }
}
