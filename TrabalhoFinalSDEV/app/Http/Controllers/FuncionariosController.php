<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FuncionariosController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::with(['user', 'funcao', 'estado', 'nivel'])->get();
        return response()->json($funcionarios);
    }

    // Criar novo funcionário (cria primeiro o funcionario, depois o user)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'cod_funcao' => 'required|exists:Funcao,cod_funcao',
            'cod_estado' => 'required|exists:Funcionario_Estado,cod_estado',
            'cod_nivel'  => 'required|exists:Nivel,cod_nivel',
        ]);

        DB::beginTransaction();

        try {
            // Criar funcionário
            $funcionario = Funcionario::create([
                'cod_funcao' => $validated['cod_funcao'],
                'cod_estado' => $validated['cod_estado'],
                'cod_nivel'  => $validated['cod_nivel'],
            ]);

            // Criar user associado
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'cod_funcionario' => $funcionario->cod_funcionario,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Funcionário e utilizador criados com sucesso',
                'user' => $user,
                'funcionario' => $funcionario,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao criar funcionário.'], 500);
        }
    }

    // Mostrar funcionário específico
    public function show($cod_funcionario)
    {
        $funcionario = Funcionario::with(['user', 'funcao', 'estado', 'nivel'])->find($cod_funcionario);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        return response()->json($funcionario);
    }

    // Atualizar funcionário
    public function update(Request $request, $cod_funcionario)
    {
        $funcionario = Funcionario::with('user')->find($cod_funcionario);

        if (!$funcionario || !$funcionario->user) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $funcionario->user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'cod_funcao' => 'required|exists:Funcao,cod_funcao',
            'cod_estado' => 'required|exists:Funcionario_Estado,cod_estado',
            'cod_nivel'  => 'required|exists:Nivel,cod_nivel',
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

            return response()->json(['message' => 'Funcionário atualizado com sucesso']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao atualizar funcionário.'], 500);
        }
    }

    // Eliminar funcionário e user associado
    public function destroy($cod_funcionario)
    {
        $funcionario = Funcionario::with('user')->find($cod_funcionario);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        DB::beginTransaction();

        try {
            if ($funcionario->user) {
                $funcionario->user->delete();
            }

            $funcionario->delete();

            DB::commit();
            return response()->json(['message' => 'Funcionário e utilizador apagados com sucesso']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao eliminar funcionário.'], 500);
        }
    }
}
