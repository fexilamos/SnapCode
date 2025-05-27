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

class FuncionariosController extends Controller
{
    // Listar funcionários
    public function index()
    {
        $funcionarios = Funcionario::with(['user', 'funcao', 'estado', 'nivel'])->get();
        return view('funcionarios.index', compact('funcionarios'));
    }

    // Formulário de criar novo funcionário
    public function create()
    {
        $funcoes = Funcao::all();
        $estados = FuncionarioEstado::all();
        $niveis = Nivel::all();
        return view('funcionarios.create', compact('funcoes', 'estados', 'niveis'));
    }

    // Guardar novo funcionário
    public function store(StoreUpdateFuncionarioRequest $request)
    {
         DB::transaction(function () use ($request) {
            // Cria o funcionário
            $funcionario = Funcionario::create($request->only([
                'nome', 'email', 'nif', 'telemovel', 'cod_funcao', 'cod_estado', 'cod_nivel'
            ]));

            // Cria o user associado (ajusta password conforme necessidade)
            User::create([
                'name' => $request->input('nome'),
                'email' => $request->input('email'),
                'password' => Hash::make('password'),
                'cod_funcionario' => $funcionario->cod_funcionario,
            ]);
        });

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário e utilizador criados com sucesso!');
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
