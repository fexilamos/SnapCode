<?php

use App\Http\Controllers\Materiais\MaterialController;
use App\Http\Controllers\Materiais\AvariaController;
use App\Http\Controllers\Funcionarios\FuncionariosController;
use App\Http\Controllers\Materiais\PerdaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Servico\ServicoController;
use App\Http\Controllers\Servico\ServicoCheckinController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'nivel:1,2,3'])->name('dashboard');

//SERVIÇOS/EVENTOS

Route::middleware('auth','nivel:1')->group(function () {
    Route::get('/servicos/create', [ServicoController::class, 'create'])->name('servicos.create');
    Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos.store');
    Route::get('/servicos/{servico}/edit', [ServicoController::class, 'edit'])->name('servicos.edit');
    Route::put('/servicos/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::delete('/servicos/{servico}', [ServicoController::class, 'destroy'])->name('servicos.destroy');
    Route::get('/servicos/{id}/pdf', [ServicoController::class, 'exportPdf'])->name('servicos.pdf');
});

Route::middleware('auth','nivel:1,2')->group(function () {
    Route::get('/servicos/home', [ServicoController::class, 'home'])->name('servicos.home');
    Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos.index');
    Route::get('/servicos/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
    Route::get('/servicos/{id}/pdf', [ServicoController::class, 'exportPdf'])->name('servicos.pdf');
});

//MATERIAIS
Route::middleware('auth','nivel:1,2')->group(function () {
    Route::get('/materiais/home', [MaterialController::class, 'home'])->name('materiais.home');
    Route::get('/materiais', [MaterialController::class, 'index'])->name('materiais.index');
    Route::get('/materiais/create', [MaterialController::class, 'create'])->name('materiais.create');
    Route::post('/materiais', [MaterialController::class, 'store'])->name('materiais.store');
    Route::get('/materiais/{material}/edit', [MaterialController::class, 'edit'])->name('materiais.edit');
    Route::put('/materiais/{material}', [MaterialController::class, 'update'])->name('materiais.update');
    Route::delete('/materiais/{material}', [MaterialController::class, 'destroy'])->name('materiais.destroy');
    Route::get('/materiais/{material}', [MaterialController::class, 'show'])->name('materiais.show');
});

//FUNCIONARIOS/Colaboradores

Route::get('funcionarios/home', [FuncionariosController::class, 'home'])->name('funcionarios.home');
Route::resource('funcionarios', FuncionariosController::class)->middleware('auth','nivel:1');

//AVARIAS
Route::middleware('auth','nivel:1,2')->group(function () {
    Route::get('/avarias', [AvariaController::class, 'index'])->name('avarias.index');
    Route::get('/avarias/create', [AvariaController::class, 'create'])->name('avarias.create');
    Route::post('/avarias', [AvariaController::class, 'store'])->name('avarias.store');
    Route::get('/avarias/{avaria}', [AvariaController::class, 'show'])->name('avarias.show');
    Route::get('/avarias/{avaria}/edit', [AvariaController::class, 'edit'])->name('avarias.edit');
    Route::put('/avarias/{avaria}', [AvariaController::class, 'update'])->name('avarias.update');
    Route::delete('/avarias/{avaria}', [AvariaController::class, 'destroy'])->name('avarias.destroy');
});

//PERDAS
Route::middleware('auth','nivel:1,2')->group(function () {
    Route::resource('perdas', PerdaController::class);
    Route::get('/perdas', [PerdaController::class, 'index'])->name('perdas.index');
    Route::get('/perdas/{perda}', [PerdaController::class, 'show'])->name('perdas.show');
    Route::get('/perdas/create', [PerdaController::class, 'create'])->name('perdas.create');
    Route::post('/perdas', [PerdaController::class, 'store'])->name('perdas.store');
    Route::get('/perdas/{perda}/edit', [PerdaController::class, 'edit'])->name('perdas.edit');
    Route::put('/perdas/{perda}', [PerdaController::class, 'update'])->name('perdas.update');
});

Route::middleware('auth','nivel:1')->group(function () {
    Route::get('/perdas/create', [PerdaController::class, 'create'])->name('perdas.create');
    Route::post('/perdas', [PerdaController::class, 'store'])->name('perdas.store');
    Route::get('/perdas/{perda}/edit', [PerdaController::class, 'edit'])->name('perdas.edit');
    Route::put('/perdas/{perda}', [PerdaController::class, 'update'])->name('perdas.update');
    Route::delete('/perdas/{perda}', [PerdaController::class, 'destroy'])->name('perdas.destroy');
});

//CHECK-IN

Route::middleware(['auth', 'nivel:1'])->group(function () {
    Route::get('/servicos/{servico}/checkin', [ServicoCheckinController::class, 'create'])->name('servicos.checkin.create');
    Route::post('/servicos/{servico}/checkin', [ServicoCheckinController::class, 'store'])->name('servicos.checkin.store');
});

//EVENTOS FUNC Externo (Nivel 3)

Route::middleware(['auth', 'nivel:3'])->get('/meus-servicos', [ServicoController::class, 'meusServicos'])->name('servicos.meus');

// Rotas para filtrar eventos por tipo
Route::get('/servicos/tipo/{tipo}', [ServicoController::class, 'listarPorTipo'])->name('servicos.tipo');


require __DIR__.'/auth.php';
Route::get('/teste', function () {
    return view('teste');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/calendario', function () {
    return view('calendario');
})->middleware(['auth']);




