<?php

use app\Http\Controllers\MaterialController;
use App\Http\Controllers\AvariaController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\PerdaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//SERVIÇOS

Route::middleware('nivel:1,2')->group(function () {
    Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos.index');
    Route::get('/servicos/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
});

Route::middleware('nivel:1')->group(function () {
    Route::get('/servicos/create', [ServicoController::class, 'create'])->name('servicos.create');
    Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos.store');
    Route::get('/servicos/{servico}/edit', [ServicoController::class, 'edit'])->name('servicos.edit');
    Route::put('/servicos/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::delete('/servicos/{servico}', [ServicoController::class, 'destroy'])->name('servicos.destroy');
});

//MATERIAIS
Route::middleware('nivel:1,2')->group(function () {
    Route::get('/materiais', [MaterialController::class, 'index'])->name('materiais.index');
    Route::get('/materiais/{material}', [MaterialController::class, 'show'])->name('materiais.show');
});

Route::middleware('nivel:1')->group(function () {
    Route::get('/materiais/create', [MaterialController::class, 'create'])->name('materiais.create');
    Route::post('/materiais', [MaterialController::class, 'store'])->name('materiais.store');
    Route::get('/materiais/{material}/edit', [MaterialController::class, 'edit'])->name('materiais.edit');
    Route::put('/materiais/{material}', [MaterialController::class, 'update'])->name('materiais.update');
    Route::delete('/materiais/{material}', [MaterialController::class, 'destroy'])->name('materiais.destroy');
});

//FUNCIONARIOS
Route::resource('funcionarios', FuncionariosController::class)->middleware('nivel:1');

//AVARIAS
Route::middleware('nivel:1,2')->group(function () {
    Route::get('/avarias', [AvariaController::class, 'index'])->name('avarias.index');
    Route::get('/avarias/{avaria}', [AvariaController::class, 'show'])->name('avarias.show');
});

Route::middleware('nivel:1')->group(function () {
    Route::get('/avarias/create', [AvariaController::class, 'create'])->name('avarias.create');
    Route::post('/avarias', [AvariaController::class, 'store'])->name('avarias.store');
    Route::get('/avarias/{avaria}/edit', [AvariaController::class, 'edit'])->name('avarias.edit');
    Route::put('/avarias/{avaria}', [AvariaController::class, 'update'])->name('avarias.update');
    Route::delete('/avarias/{avaria}', [AvariaController::class, 'destroy'])->name('avarias.destroy');
});

//PERDAS
Route::middleware('nivel:1,2')->group(function () {
    Route::get('/perdas', [PerdaController::class, 'index'])->name('perdas.index');
    Route::get('/perdas/{perda}', [PerdaController::class, 'show'])->name('perdas.show');
});

Route::middleware('nivel:1')->group(function () {
    Route::get('/perdas/create', [PerdaController::class, 'create'])->name('perdas.create');
    Route::post('/perdas', [PerdaController::class, 'store'])->name('perdas.store');
    Route::get('/perdas/{perda}/edit', [PerdaController::class, 'edit'])->name('perdas.edit');
    Route::put('/perdas/{perda}', [PerdaController::class, 'update'])->name('perdas.update');
    Route::delete('/perdas/{perda}', [PerdaController::class, 'destroy'])->name('perdas.destroy');
});



require __DIR__.'/auth.php';
Route::get('/teste', function () {
    return view('teste');
});
Route::get('/', function () {
    return view('welcome'); // Sem scripts React aqui
});

