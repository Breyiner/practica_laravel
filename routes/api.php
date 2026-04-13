<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('prueba', function () {
    return response()->json(
        [
            "Respuesta" => "normal"
        ]
    );
});

Route::prefix('prefix')->group(function () {
    Route::get('/', function () {
        return response()->json(
            [
                "Respuesta" => "prefix"
            ]
        );
    });
});

Route::post('login', [AuthController::class, 'login'])->middleware(['throttle:10,1']);
Route::post('logout', [AuthController::class, 'logout']);

Route::prefix('v1')->middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::resource('productos', ProductoController::class)->except(['create', 'edit']);


    Route::resource('categorias', CategoriaController::class)->except(['create', 'edit']);
});