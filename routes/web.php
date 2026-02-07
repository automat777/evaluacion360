<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\HomeController;

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('welcome');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/evaluaciones/relacion', [EvaluacionController::class, 'create'])->name('evaluaciones.create');
Route::post('/evaluaciones', [EvaluacionController::class, 'store'])->name('evaluaciones.store');

// Ruta para mostrar el formulario
Route::get('/calificacion', [CalificacionController::class, 'index'])->name('calificacion.index');

// Ruta para procesar y guardar los datos
Route::post('/calificacion', [CalificacionController::class, 'store'])->name('calificacion.store');
