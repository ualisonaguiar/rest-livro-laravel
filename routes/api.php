<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LivroController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\VendaController;
use Illuminate\Http\Request;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});


Route::middleware('api')->get('/user', function(Request $request) {
    return $request->user();
});
