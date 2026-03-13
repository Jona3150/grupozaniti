<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Proyecto Zaniti
|--------------------------------------------------------------------------
| Aquí se definen los puntos de acceso para AngularJS.
| Laravel añade automáticamente el prefijo "/api" a estas rutas.
*/

// Importamos los controladores necesarios
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\InventarioController;

// Ruta para obtener los datos del Dashboard (Métricas y Resumen)
Route::get('/dashboard/resumen', [DashboardController::class, 'getResumen']);

// Ruta para obtener el listado completo de productos del Inventario
// URL de acceso: http://127.0.0.1:8000/api/inventario
Route::get('/inventario', [InventarioController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Protección de Usuario (Opcional por ahora)
|--------------------------------------------------------------------------
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');