<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RecetaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('recetas.index');
});

// Rutas para Recetas
Route::resource('recetas', RecetaController::class);

// Rutas para Categorías
Route::resource('categorias', CategoriaController::class);