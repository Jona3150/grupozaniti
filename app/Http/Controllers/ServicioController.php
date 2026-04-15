<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function show($slug)
    {
        $servicios_info = [

            'plagas' => [
                'titulo' => 'Manejo Integrado de Plagas',
                'descripcion' => 'Control y prevención de plagas.',
                'incluye' => [
                    'Inspección  Tratamiento y Evaluación.',
                    'Identificación',
                    'Recomendación,',
                    'Tratamiento,',
                    'Evaluación.'
                ],
                'hero' => 'img/plagas-hero.png',
                'desc' => 'En Zaniti nuestro equipo está altamente capacitado para ofrecerte un servicio de calidad, apegándonos a las normas y necesidades de cada uno de nuestros clientes.',
                'galeria' => [
                    'img/plagas1.jpg',
                    'img/plagas2.jpg',
                    'img/plagas3.jpg'
                ]
            ],

            'desinfeccion' => [
                'titulo' => 'Desinfección de espacios',
                'descripcion' => 'Procesos meticulosos y detallados para la desinfección de superficies y purificación de ambientes.',
                'incluye' => [
                    'Desinfección de superficies con productos 100% biodegradables, no tóxicos para eliminar virus, bacterias y hongos.',
                    'Servicio en 3 etapas: Aspersión, Termonebulización y Aerosoles desinfectantes.'
                ],
                'hero' => 'img/Desinfeccion.png',
                'desc' => 'En Zaniti, nuestro equipo de expertos está altamente capacitado
          para ofrecerte un servicio de calidad, garantizando un ambiente limpio
          y seguro, bajo los más altos estándares profesionales.',
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
                    'Limpieza de sanitarios'
                ],
                'hero' => 'img/plagas-hero.png',
                'desc' => 'En Zaniti, nuestro equipo de expertos está altamente capacitado
          para ofrecerte un servicio de calidad, garantizando un ambiente limpio
          y seguro, bajo los más altos estándares profesionales.',
                'galeria' => [
                    'img/limpieza1.png',
                    'img/plagas3.jpg',
                    'img/foto2.jpg'
                ]
            ],

            'mantenimiento' => [
                'titulo' => 'Mantenimiento',
                'descripcion' => 'Servicio de mantenimiento básico para diferentes instalaciones.',
                'incluye' => [
                    'Pintura',
                    'Resane de superficies',
                    'étodos mecánicos para ayudar al control de plagas',
                    'Luminaria'
                ],
                'hero' => 'img/foto1.jpg',
                'desc' => '',
                'galeria' => [
                    'img/plagas-hero.png',
                    'img/mantenimiento2.png',
                    'img/mantenimiento3.png'
                ]
            ],

            'venta' => [
                'titulo' => 'Venta de maquinaria y equipo',
                'descripcion' => 'Venta de maquinaria y equipo para limpieza, desinfección y control de plagas.',
                'incluye' => [
                    'Venta de equipos para diferentes necesidades',
                    'Asesoría técnica'
                ],
                'hero' => 'img/equipos.png',
                'desc' => '',
                'galeria' => [
                    'img/equipos1.png',
                    'img/equipos2.png',
                    'img/equipos3.png'
                ]
            ],

            'reparacion' => [
                'titulo' => 'Reparación de equipos y venta de refacciones',
                'descripcion' => 'Reparación de equipos y venta de refacciones',
                'incluye' => [
                    'Diagnóstico técnico',
                    'Reparación de equipos',
                    'Cambio de refacciones',
                    'Mantenimiento preventivo',
                    'Venta de refacciones para nuestros equipos.'
                ],
                'hero' => 'img/reparacion.png',
                'desc' => '',
                'galeria' => [
                    'img/reparacion1.png',
                    'img/reparacion2.png',
                    'img/reparacion3.png'
                ]
            ],

            'ventas' => [
                'titulo' => 'Venta de productos para fumigación',
                'descripcion' => 'Productos 100% originales con registros COFEPRIS vigentes.',
                'incluye' => [
                    'Asesoria y orientacion',
                    'Variedad de productos'
                ],
                'hero' => 'img/reparacion.png',
                'desc' => '',
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