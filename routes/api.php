<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\Api\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/up', function () {
    return response()->json(['status' => 'ok']);
});

// Route::prefix('/users')->controller(UsersController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::post('/', 'store');
//     Route::put('/{id}', 'update');
//     Route::delete('/{id}', 'delete');
// });

Route::prefix('/livros')->controller(LivroController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
})->middleware('api');

Route::prefix('/vendas')->controller(VendaController::class)->group(function () {
    Route::get('/', 'listagem');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);

});

Route::middleware(['jwt.auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});