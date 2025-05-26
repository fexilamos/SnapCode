<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeusServicosController extends Controller
{
    public function meusServicos()
    {
        $funcionario = auth()->user()->funcionario; // Assumindo relação user->funcionario
        $servicos = $funcionario->servicos()->with(['cliente', 'tipoServico', 'localizacao'])->get();
        return view('servicos.meus', compact('servicos'));
    }
}
