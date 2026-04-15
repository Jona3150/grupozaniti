<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // Excluir todas las rutas de productos del CSRF para pruebas externas
        $middleware->validateCsrfTokens(except: [
            'productos/guardar',
            'productos/actualizar/*',
            'productos/eliminar/*',
        ]);

        // Mantener la protección contra el retroceso en el historial
        $middleware->web(append: [
            \App\Http\Middleware\PreventBackHistory::class,
        ]);

        
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();