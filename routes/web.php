<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluacionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/evaluaciones/crear', [EvaluacionController::class, 'create'])->name('evaluaciones.create');
Route::post('/evaluaciones', [EvaluacionController::class, 'store'])->name('evaluaciones.store');
