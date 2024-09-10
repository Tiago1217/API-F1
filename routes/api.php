<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PilotoController;

// Status da API
Route::get('/status', function () {
    return response()->json(['status' => 'API is working']);
});

// Rotas para o controlador Piloto
Route::prefix('pilotos')->group(function () {
    Route::get('/', [PilotoController::class, 'index']); // Listar todos os pilotos
    Route::get('/{id}', [PilotoController::class, 'show']); // Mostrar um piloto específico
    Route::post('/', [PilotoController::class, 'store']); // Criar um novo piloto
    Route::put('/{id}', [PilotoController::class, 'update']); // Atualizar um piloto existente
    Route::delete('/{id}', [PilotoController::class, 'destroy']); // Deletar um piloto
});
