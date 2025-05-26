<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNivel
{
    public function handle(Request $request, Closure $next, ...$niveis): Response
    {
        $user = auth()->user();

        if (!$user || !$user->funcionario) {
            abort(403, 'Acesso não autorizado.');
        }

        $codNivelFuncionario = $user->funcionario->cod_nivel;

        if (!in_array($codNivelFuncionario, $niveis)) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
