<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CotizacionController;

/*
|--------------------------------------------------------------------------
| Web Routes - Proyecto ZanitiMVC
|--------------------------------------------------------------------------
| Aquí se definen todas las rutas de la aplicación. Cada ruta responde a 
| una URL específica y llama a una Vista o a un Controlador.
*/

// 1. Ruta de la Página de Inicio
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// 2. Ruta de la Página "Conócenos" (Nosotros)
Route::get('/nosotros', function () {
    return view('nosotros');
})->name('nosotros');

// 3. Rutas de la Página de Contacto
// Mostramos la vista
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Procesamos el formulario (POST)
Route::post('/contacto/enviar', [ContactoController::class, 'submit'])->name('contacto.enviar');

// 4. Rutas de la Página de Cotización
// Mostramos la vista
Route::get('/cotizacion', function () {
    return view('cotizacion');
})->name('cotizacion');

// Procesamos el formulario con lógica de cálculo y archivos (POST)
Route::post('/cotizacion/enviar', [CotizacionController::class, 'submit'])->name('cotizacion.enviar');

// 5. Ruta Dinámica de Servicios Detallados
// El parámetro {servicio} permite que una sola vista muestre múltiples servicios
Route::get('/servicios/{servicio}', [ServicioController::class, 'show'])->name('servicios.show');