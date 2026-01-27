<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function show($slug)
    {
        $servicios_info = [
            'plagas' => [
                'titulo' => 'Control y prevención de plagas',
                'descripcion' => 'Diagnóstico, aplicación y seguimiento para eliminar y prevenir infestaciones con productos originales.',
                'incluye' => ['Diagnóstico profesional', 'Aplicación de productos seguros', 'Seguimiento preventivo'],
                'hero' => 'img/plagas-hero.png'
            ],
            'desinfeccion' => [
                'titulo' => 'Desinfección de espacios',
                'descripcion' => 'Procesos meticulosos con insumos biodegradables y seguros mediante termo nebulización.',
                'incluye' => ['Sanitización profunda', 'Insumos biodegradables', 'Personal certificado'],
                'hero' => 'img/foto1.jpg'
            ],
            // Agrega aquí los demás (limpieza, mantenimiento, venta, reparacion) igual que en el paso anterior
        ];

        // Verificamos si el servicio existe, si no, mandamos al de plagas por defecto
        $info = $servicios_info[$slug] ?? $servicios_info['plagas'];

        // Enviamos los datos a la vista
        return view('servicios-detallados', compact('info'));
    }
}