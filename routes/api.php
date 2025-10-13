<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CepController;
use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/up', function () {
    return response()->json(['status' => 'ok']);
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['jwt.auth'])->group(function () {

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::get('refresh', 'refresh');
        Route::get('profile', 'profile');
    });

    Route::get('/busca-cep/{cep}', [CepController::class, 'buscarCep']);

    Route::apiResource('usuario', UsuarioController::class);
    Route::apiResource('livros', LivroController::class);
    Route::apiResource('vendas', VendaController::class);
});
