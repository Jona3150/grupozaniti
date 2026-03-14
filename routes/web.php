<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Controladores de la Landing Page (Públicos)
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CotizacionController;

// Controladores del Panel Administrativo (Protegidos)
use App\Http\Controllers\Api\InventarioController;
use App\Http\Controllers\Api\ServicioController as ApiServicioController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS (Landing Page - Accesibles para todos)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('inicio'); })->name('inicio');
Route::get('/nosotros', function () { return view('nosotros'); })->name('nosotros');
Route::get('/contacto', function () { return view('contacto'); })->name('contacto');
Route::get('/cotizacion', function () { return view('cotizacion'); })->name('cotizacion');

// Rutas de envío de formularios (Landing)
Route::post('/contacto/enviar', [ContactoController::class, 'submit'])->name('contacto.enviar');
Route::post('/cotizacion/enviar', [CotizacionController::class, 'submit'])->name('cotizacion.enviar');

// Ruta dinámica de servicios (La que agregó tu compañero)
Route::get('/servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::get('/admin-login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin-login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (Requieren Iniciar Sesión)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // --- Dashboard y Estadísticas ---
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/perfil', function () { return view('perfil'); })->name('perfil');
    Route::get('/datos-dashboard', [DashboardController::class, 'getStats']);

    // --- Gestión de Técnicos (Users) ---
    Route::get('/datos-empleados', function () {
        return \App\Models\User::whereIn('role', ['admin', 'empleado', 'dueño'])->get();
    });

    // --- Módulo de Inventario ---
    Route::get('/inventario', function () { return view('inventario'); })->name('inventario');
    Route::get('/datos-inventario', [InventarioController::class, 'index']);
    Route::post('/productos/guardar', [InventarioController::class, 'store']);
    Route::post('/productos/actualizar/{id}', [InventarioController::class, 'update']);
    Route::post('/productos/eliminar/{id}', [InventarioController::class, 'destroy']);

    // --- Módulo de Calendario de Servicios ---
    Route::get('/calendario', function () { return view('calendario'); })->name('calendario');
    Route::get('/datos-servicios', [ApiServicioController::class, 'index']);
    Route::post('/servicios/guardar', [ApiServicioController::class, 'store']);
    Route::post('/servicios/actualizar/{id}', [ApiServicioController::class, 'update']);
    Route::post('/servicios/eliminar/{id}', [ApiServicioController::class, 'destroy']);

    // --- Módulo de Clientes ---
    Route::get('/clientes', function () { return view('clientes'); })->name('clientes');
    Route::get('/datos-clientes', [ClienteController::class, 'index']);
    Route::post('/clientes/guardar', [ClienteController::class, 'store']);
    Route::post('/clientes/actualizar/{id}', [ClienteController::class, 'update']);
    Route::post('/clientes/eliminar/{id}', [ClienteController::class, 'destroy']);
});