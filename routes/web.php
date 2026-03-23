<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Controladores de la Landing Page
use App\Http\Controllers\ServicioController;

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CotizacionController;

// Controladores de la API / Panel Administrativo
use App\Http\Controllers\Api\InventarioController;
use App\Http\Controllers\Api\ServicioController as ApiServicioController;
use App\Http\Controllers\Api\ClienteController;

use App\Http\Controllers\Api\DashboardController;


/* |-------------------------------------------------------------------------- | Web Routes - Proyecto Zaniti |-------------------------------------------------------------------------- */

// --- RUTAS PÚBLICAS (Landing Page) ---
// Estas rutas son accesibles para cualquier visitante.

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::post('/contacto/enviar', [ContactoController::class , 'submit'])->name('contacto.enviar');

Route::get('/cotizacion', function () {
    return view('cotizacion');
})->name('cotizacion');

Route::post('/cotizacion/enviar', [CotizacionController::class , 'submit'])->name('cotizacion.enviar');

Route::get('/servicios/{servicio}', [ServicioController::class , 'show'])->name('servicios.show');

Route::get('/servicio/limpieza', [ServicioController::class , 'limpieza']);

// --- AUTENTICACIÓN ---

Route::get('/admin-login', function () {
    return view('login');
})->name('login'); // Nombre 'login' es vital para que el middleware auth sepa a dónde redirigir


// --- RUTAS DE ACCESO ---
// El nombre 'login' es obligatorio para que el middleware sepa a dónde expulsar a los intrusos
Route::get('/admin-login', [App\Http\Controllers\LoginController::class , 'showLoginForm'])->name('login');
Route::post('/admin-login', [App\Http\Controllers\LoginController::class , 'login']);

// El logout ya lo tienes, pero asegúrate de que use el nombre 'login' al final
Route::post('/logout', [App\Http\Controllers\LoginController::class , 'logout'])->name('logout');



// --- CERRAR SESIÓN (LOGOUT) ---
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


// --- RUTAS PROTEGIDAS (Requieren Iniciar Sesión) ---
// Todo lo que esté dentro de este grupo pide autenticación.

Route::middleware(['auth'])->group(function () {

    // --- DASHBOARD Y GENERALES ---
    Route::get('/dashboard', function () {
            return view('dashboard');
        }
        )->name('dashboard');

        Route::get('/perfil', function () {
            return view('perfil');
        }
        )->name('perfil');

        Route::get('/datos-dashboard', [DashboardController::class , 'getStats']);

        // Ruta para técnicos (Sonia, Fernando, Víctor)
        Route::get('/datos-empleados', function () {
            return \App\Models\User::whereIn('role', ['admin', 'empleado', 'dueño'])->get();
        }
        );

        // --- MÓDULO DE INVENTARIO ---
        Route::get('/inventario', function () {
            return view('inventario');
        }
        )->name('inventario');

        Route::get('/datos-inventario', [InventarioController::class , 'index']);
        Route::post('/productos/guardar', [InventarioController::class , 'store']);
        Route::post('/productos/eliminar/{id}', [InventarioController::class , 'destroy']);
        Route::post('/productos/actualizar/{id}', [InventarioController::class , 'update']);


        // --- MÓDULO DE CALENDARIO DE SERVICIOS ---
        Route::get('/calendario', function () {
            return view('calendario');
        }
        )->name('calendario');

        Route::get('/datos-servicios', [ApiServicioController::class , 'index']);
        Route::post('/servicios/guardar', [ApiServicioController::class , 'store']);
        Route::post('/servicios/actualizar/{id}', [ApiServicioController::class , 'update']);
        Route::post('/servicios/eliminar/{id}', [ApiServicioController::class , 'destroy']);


        // --- MÓDULO DE CLIENTES ---
        Route::get('/clientes', function () {
            return view('clientes');
        }
        )->name('clientes');

        Route::get('/datos-clientes', [ClienteController::class , 'index']);
        Route::post('/clientes/guardar', [ClienteController::class , 'store']);
        Route::post('/clientes/actualizar/{id}', [ClienteController::class , 'update']);
        Route::post('/clientes/eliminar/{id}', [ClienteController::class , 'destroy']);

        // Ruta dinámica para los 6 servicios        
        Route::get('/servicios/{slug}', [App\Http\Controllers\ServicioController::class , 'show']);

        // Esta ruta atrapará /servicios/plagas, /servicios/venta, etc.        
        Route::get('/servicios/{slug}', [ServicioController::class , 'show'])->name('servicios.show');
    });