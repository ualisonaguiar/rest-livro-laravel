<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/up', function() {
    return response()->json(['status' => 'ok']);
});

Route::prefix('/users')->controller(UsersController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('/livros')->controller(LivroController::class)->group(function() {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'edit');
    Route::delete('/{id}', 'destroy');
});

Route::prefix('/vendas')->controller(VendaController::class)->group(function() {
    Route::get('/', 'listagem');
    Route::post('/', 'store');
    Route::put('/{id}', 'edit');
    Route::delete('/{id}', 'destroy');
});
