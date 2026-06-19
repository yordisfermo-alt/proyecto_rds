<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\FuncionescargoController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']); //Esta es para reguistra usuarios
Route::post('/login', [AuthController::class, 'login']); // Esta es para loguin de un usuario


// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Esta es para cerrar la sesion
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/empleados/{empleado}/detalle', [EmpleadoController::class, 'detalle']);
    Route::apiResource('empleados', EmpleadoController::class);
    Route::apiResource('cargos', CargoController::class);
    Route::apiResource('funciones-cargo', FuncionesCargoController::class);
});
