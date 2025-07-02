<?php

use Illuminate\Support\Facades\Route;
use App\Models\Servico;

Route::get('/calendario', function () {
    $eventos = Servico::all();
    $eventosFullCalendar = $eventos->map(function($evento) {
        return [
            'title' => $evento->nome_servico ?? 'Evento',
            'start' => $evento->data_inicio,
            'end'   => $evento->data_fim,
            'url'   => route('servicos.show', $evento->cod_servico), // link para a view do evento
        ];
    });
    return view('calendario', [
        'eventos' => $eventosFullCalendar
    ]);
})->middleware(['auth', 'nivel:1,2']);
