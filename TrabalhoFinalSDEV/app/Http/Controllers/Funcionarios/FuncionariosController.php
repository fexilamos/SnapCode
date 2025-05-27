<?php

namespace App\Http\Controllers\Funcionarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Funcionario;
use App\Models\Funcao;
use App\Models\FuncionarioEstado;
use App\Models\Nivel;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'cod_funcao' => 'required|exists:funcao,cod_funcao',
            'cod_estado' => 'required|exists:funcionario_estado,cod_estado',
            'cod_nivel'  => 'required|exists:nivel,cod_nivel',
        ]);

        DB::beginTransaction();

        try {
            $funcionario = Funcionario::create([
                'cod_funcao' => $validated['cod_funcao'],
                'cod_estado' => $validated['cod_estado'],
                'cod_nivel'  => $validated['cod_nivel'],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'cod_funcionario' => $funcionario->cod_funcionario,
            ]);

            DB::commit();

            return redirect()->route('funcionarios.index')->with('success', 'Funcionário e utilizador criados com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar funcionário.']);
        }
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
    public function update(Request $request, $cod_funcionario)
    {
        $funcionario = Funcionario::with('user')->find($cod_funcionario);

        if (!$funcionario || !$funcionario->user) {
            return redirect()->route('funcionarios.index')->with('error', 'Funcionário não encontrado.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $funcionario->user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'cod_funcao' => 'required|exists:funcao,cod_funcao',
            'cod_estado' => 'required|exists:funcionario_estado,cod_estado',
            'cod_nivel'  => 'required|exists:nivel,cod_nivel',
        ]);

        DB::beginTransaction();

        try {
            $user = $funcionario->user;
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();

            $funcionario->update([
                'cod_funcao' => $validated['cod_funcao'],
                'cod_estado' => $validated['cod_estado'],
                'cod_nivel'  => $validated['cod_nivel'],
            ]);

            DB::commit();

            return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao atualizar funcionário.']);
        }
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
