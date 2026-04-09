<?php

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


Route::prefix('v1')->group(function () {
    Route::resource('productos', ProductoController::class)->except(['create', 'edit']);
});