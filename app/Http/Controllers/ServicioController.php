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
                'incluye' => [
                    'Diagnóstico profesional',
                    'Aplicación de productos seguros',
                    'Seguimiento preventivo'
                ],
                'hero' => 'img/plagas-hero.png',

                'galeria' => [
                    'img/plagas1.jpg',
                    'img/plagas2.jpg',
                    'img/plagas3.jpg'
                ]
            ],

            'desinfeccion' => [
                'titulo' => 'Desinfección de espacios',
                'descripcion' => 'Procesos meticulosos con insumos biodegradables y seguros mediante termo nebulización.',
                'incluye' => [
                    'Sanitización profunda',
                    'Insumos biodegradables',
                    'Personal certificado'
                ],
                'hero' => 'img/foto1.jpg',

                'galeria' => [
                    'img/desinfeccion1.png',
                    'img/desinfeccion2.png',
                    'img/desinfeccion3.png'
                ]
            ],

            'limpieza' => [
                'titulo' => 'Limpieza en general',
                'descripcion' => 'Servicio integral de limpieza para mantener espacios higiénicos, ordenados y seguros.',
                'incluye' => [
                    'Limpieza profunda de áreas comunes',
                    'Limpieza de pisos, muebles y superficies',
                    'Recolección de residuos',
                    'Limpieza de sanitarios',
                    'Mantenimiento básico de áreas'
                ],
                'hero' => 'img/plagas-hero.png',

                'galeria' => [
                    'img/limpieza1.png',
                    'img/plagas3.jpg',
                    'img/foto2.jpg'
                ]
            ],

            'mantenimiento' => [
                'titulo' => 'Mantenimiento en general',
                'descripcion' => 'Servicio de mantenimiento preventivo y correctivo para diferentes instalaciones.',
                'incluye' => [
                    'Revisión general de instalaciones',
                    'Reparaciones menores',
                    'Ajustes y mantenimiento preventivo',
                    'Diagnóstico de fallas'
                ],
                'hero' => 'img/foto1.jpg',

                'galeria' => [
                    'img/plagas-hero.png',
                    'img/mantenimiento2.png',
                    'img/mantenimiento3.png'
                ]
            ],

            'venta' => [
                'titulo' => 'Venta de equipos y refacciones',
                'descripcion' => 'Venta de equipos y refacciones especializadas para limpieza y control de plagas.',
                'incluye' => [
                    'Equipos especializados',
                    'Refacciones originales',
                    'Productos certificados',
                    'Asesoría técnica'
                ],
                'hero' => 'img/equipos.png',

                'galeria' => [
                    'img/equipos1.png',
                    'img/equipos2.png',
                    'img/equipos3.png'
                ]
            ],

            'reparacion' => [
                'titulo' => 'Reparación de equipos',
                'descripcion' => 'Servicio técnico especializado para reparación y mantenimiento de equipos.',
                'incluye' => [
                    'Diagnóstico técnico',
                    'Reparación de equipos',
                    'Cambio de refacciones',
                    'Mantenimiento preventivo'
                ],
                'hero' => 'img/reparacion.png',

                'galeria' => [
                    'img/reparacion1.png',
                    'img/reparacion2.png',
                    'img/reparacion3.png'
                ]
            ],

        ];

        // Si el servicio no existe, mostramos el de plagas
        $info = $servicios_info[$slug] ?? $servicios_info['plagas'];

        // En ServicioController.php        
        return view('servicios-detallados', [
            'info' => $info,
            'slug' => $slug]);
    }
}