<?php

use App\Http\Controllers\AvariaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//AVARIAS
Route::get('/avarias', [AvariaController::class, 'index'])->middleware('nivel:1,2,3')->name('avarias.index');

Route::get('/avarias/{avaria}', [AvariaController::class, 'show'])->middleware('nivel:1,2,3')->name('avarias.show');

Route::get('/avarias/create', [AvariaController::class, 'create'])->middleware('nivel:1')->name('avarias.create');

Route::post('/avarias', [AvariaController::class, 'store'])->middleware('nivel:1')->name('avarias.store');

Route::get('/avarias/{avaria}/edit', [AvariaController::class, 'edit'])->middleware('nivel:1')->name('avarias.edit');

Route::put('/avarias/{avaria}', [AvariaController::class, 'update'])->middleware('nivel:1')->name('avarias.update');

Route::delete('/avarias/{avaria}', [AvariaController::class, 'destroy'])->middleware('nivel:1')->name('avarias.destroy');



require __DIR__.'/auth.php';
Route::get('/teste', function () {
    return view('teste');
});
Route::get('/', function () {
    return view('welcome'); // Sem scripts React aqui
});
Route::get('/calendario', function () {
    return view('calendario');
})->middleware(['auth']);


