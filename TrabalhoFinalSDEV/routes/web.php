<?php

use App\Http\Controllers\Materiais\MaterialController;
use App\Http\Controllers\Materiais\AvariaController;
use App\Http\Controllers\Funcionarios\FuncionariosController;
use App\Http\Controllers\Materiais\PerdaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Servico\ServicoController;
use App\Http\Controllers\Servico\ServicoCheckinController;
use App\Http\Controllers\KitController;


// HOME & DASHBOARD
Route::get('/', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'nivel:1,2'])->name('dashboard');

// SERVIÇOS (EVENTOS)
Route::middleware('auth', 'nivel:1')->group(function () {
    Route::get('/servicos/create', [ServicoController::class, 'create'])->name('servicos.create');
    Route::post('/servicos', [ServicoController::class, 'store'])->name('servicos.store');
    Route::get('/servicos/{servico}/edit', [ServicoController::class, 'edit'])->name('servicos.edit');
    Route::put('/servicos/{servico}', [ServicoController::class, 'update'])->name('servicos.update');
    Route::get('/servicos/{id}/pdf', [ServicoController::class, 'exportPdf'])->name('servicos.pdf');
});

// **CHECK-OUT**
Route::prefix('servicos/checkout')->middleware(['auth', 'nivel:1,2'])->group(function () {

    Route::get('/', [ServicoCheckInController::class, 'home'])->name('servicos.checkout.home');
    Route::get('/index', [ServicoCheckInController::class, 'index'])->name('servicos.checkout.index');
    Route::get('/create', [ServicoCheckInController::class, 'formCheckout'])->name('servicos.checkout.create');
    Route::post('/', [ServicoCheckInController::class, 'storeCheckout'])->name('servicos.checkout.store');
    Route::get('/{servico}/edit', [ServicoCheckInController::class, 'editCheckout'])->name('servicos.checkout.edit');
    Route::put('/{servico}', [ServicoCheckInController::class, 'updateCheckout'])->name('servicos.checkout.update');
    Route::delete('/{servico}', [ServicoCheckInController::class, 'destroyCheckout'])->name('servicos.checkout.destroy');
});

// **CHECK-IN**
Route::prefix('servicos/checkin')->middleware(['auth', 'nivel:1,2'])->group(function () {

    Route::get('/', [ServicoCheckInController::class, 'homeCheckin'])->name('servicos.checkin.home');
    Route::get('/index', [ServicoCheckInController::class, 'indexCheckin'])->name('servicos.checkin.index');
    Route::get('/servicos/checkin/selecao', [ServicoCheckInController::class, 'selecionarServicoParaCheckin'])->name('servicos.checkin.selecao');
    Route::get('/{servico}/create', [ServicoCheckInController::class, 'createCheckin'])->name('servicos.checkin.create');
    Route::put('/{servico}/update', [ServicoCheckInController::class, 'updateCheckin'])->name('servicos.checkin.update');
    Route::delete('/{servico}', [ServicoCheckInController::class, 'destroyCheckin'])->name('servicos.checkin.destroy');
    Route::get('/{servico}/edit', [ServicoCheckInController::class, 'editCheckin'])->name('servicos.checkin.edit');
});

// SERVIÇOS (continuação: HOME, INDEX, SHOW)
Route::middleware('auth', 'nivel:1,2')->group(function () {
    Route::get('/servicos/home', [ServicoController::class, 'home'])->name('servicos.home');
    Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos.index');
    Route::get('/servicos/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
    Route::get('/servicos/lista-tipo', [ServicoController::class, 'listaTipo'])->name('servicos.lista-tipo');
});

// FUNCIONÁRIOS
Route::middleware('auth', 'nivel:1')->group(function () {
    Route::get('funcionarios/home', [FuncionariosController::class, 'home'])->name('funcionarios.home');
    Route::resource('funcionarios', FuncionariosController::class);
});

// MATERIAIS
Route::middleware('auth', 'nivel:1,2')->group(function () {
    Route::get('/materiais/home', [MaterialController::class, 'home'])->name('materiais.home');
    Route::get('/materiais', [MaterialController::class, 'index'])->name('materiais.index');
    Route::get('/materiais/create', [MaterialController::class, 'create'])->name('materiais.create');
    Route::post('/materiais', [MaterialController::class, 'store'])->name('materiais.store');
    Route::get('/materiais/{material}/edit', [MaterialController::class, 'edit'])->name('materiais.edit');
    Route::put('/materiais/{material}', [MaterialController::class, 'update'])->name('materiais.update');
    Route::delete('/materiais/{material}', [MaterialController::class, 'destroy'])->name('materiais.destroy');
    Route::get('/materiais/{material}', [MaterialController::class, 'show'])->name('materiais.show');
});

// AVARIAS
Route::middleware('auth', 'nivel:1,2')->group(function () {
    Route::get('/avarias', [AvariaController::class, 'index'])->name('avarias.index');
    Route::get('/avarias/create', [AvariaController::class, 'create'])->name('avarias.create');
    Route::post('/avarias', [AvariaController::class, 'store'])->name('avarias.store');
    Route::get('/avarias/{avaria}', [AvariaController::class, 'show'])->name('avarias.show');
    Route::get('/avarias/{avaria}/edit', [AvariaController::class, 'edit'])->name('avarias.edit');
    Route::put('/avarias/{avaria}', [AvariaController::class, 'update'])->name('avarias.update');
    Route::delete('/avarias/{avaria}', [AvariaController::class, 'destroy'])->name('avarias.destroy');
});

// PERDAS
Route::middleware('auth', 'nivel:1,2')->group(function () {
    Route::resource('perdas', PerdaController::class);
    Route::get('/perdas', [PerdaController::class, 'index'])->name('perdas.index');
    Route::get('/perdas/{perda}', [PerdaController::class, 'show'])->name('perdas.show');
    Route::get('/perdas/create', [PerdaController::class, 'create'])->name('perdas.create');
    Route::post('/perdas', [PerdaController::class, 'store'])->name('perdas.store');
    Route::get('/perdas/{perda}/edit', [PerdaController::class, 'edit'])->name('perdas.edit');
    Route::put('/perdas/{perda}', [PerdaController::class, 'update'])->name('perdas.update');
    Route::delete('/perdas/{perda}', [PerdaController::class, 'destroy'])->name('perdas.destroy');
});

// FUNC EXTERNO (Nível 3)
Route::middleware(['auth', 'nivel:3'])->group(function () {
    Route::get('/meus-servicos', [ServicoController::class, 'meusServicos'])->name('servicos.meus');
    // Route::get('/servicos/{servico}', [ServicoController::class, 'show'])->name('servicos.show');
    // Route::get('/servicos/{id}/pdf', [ServicoController::class, 'exportPdf'])->name('servicos.pdf');
});


// FILTRAR EVENTOS POR TIPO
Route::get('/servicos/tipo/{tipo}', [ServicoController::class, 'listarPorTipo'])->name('servicos.tipo');

// KITS
Route::get('/kits/home', [KitController::class, 'home'])->name('kits.home');
Route::resource('kits', KitController::class);

Route::get('/', function () {
    return view('welcome');
});




require __DIR__ . '/auth.php';
Route::get('/teste', function () {
    return view('teste');
});
Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/calendario_events.php';
