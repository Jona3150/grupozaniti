@extends('layouts.app')

@section('title', 'Zaniti | Creamos espacios limpios y seguros')

@section('content')
    <section id="inicio" class="hero">
    <div class="logo-main-wrap">
        <img src="{{ asset('img/logobg.png') }}" alt="Zaniti Principal" class="logo-main">
    </div>
    <br>
    <br>
    <h1>Creamos espacios limpios y seguros</h1>
    <br>
    <p>Soluciones certificadas para hogares y empresas: desinfección, control de plagas y programas preventivos con resultados confiables.</p>
    <br>
    <a href="{{ url('/cotizacion') }}" id="cotizacion-link">
        Solicitar cotización
    </a>
</section>

    <section class="carousel zaniti" aria-label="Galería Zaniti">
        <div class="carousel-viewport">
            <div class="carousel-track">
                <div class="slide"><img src="{{ asset('img/foto1.jpg') }}" alt="Foto 1"></div>
                <div class="slide"><img src="{{ asset('img/foto1.jpg') }}" alt="Foto 1"></div>
                <div class="slide"><img src="{{ asset('img/foto1.jpg') }}" alt="Foto 1"></div>
            </div>
        </div>

        <button class="carousel-btn prev" aria-label="Anterior">&#10094;</button>
        <button class="carousel-btn next" aria-label="Siguiente">&#10095;</button>

        <div class="carousel-dots" aria-label="Indicadores"></div>
    </section>

    <br>
    <h2 id="servicios">Servicios</h2>
    <br>

    <section class="servicios-flip-grid">
        <article class="servicio-flip">
            <div class="servicio-inner">
                <div class="servicio-front">
                    <div class="icono" aria-hidden="true"> 
                        <img src="{{ asset('img/plagas.png') }}" class="icono"> 
                    </div>
                    <h3>Control y prevención de plagas</h3>
                </div>
                <div class="servicio-back">
                    <h3>Control y prevención de plagas</h3>
                    <p>Diagnóstico, aplicación y seguimiento para eliminar y prevenir infestaciones.</p>
                    <a href="{{ url('/servicios/plagas') }}" class="btn-more">Ver más</a>
                </div>
            </div>
        </article>

        <article class="servicio-flip">
            <div class="servicio-inner">
                <div class="servicio-front">
                    <div class="icono" aria-hidden="true"> 
                        <img src="{{ asset('img/bactericida.png') }}" class="icono">
                    </div>
                    <h3>Desinfección de espacios</h3>
                </div>
                <div class="servicio-back">
                    <h3>Desinfección de espacios</h3>
                    <p>Procesos meticulosos con insumos biodegradables y seguros.</p>
                    <a href="{{ url('/servicios/desinfeccion') }}" class="btn-more">Ver más</a>
                </div>
            </div>
        </article>

        <article class="servicio-flip">
            <div class="servicio-inner">
                <div class="servicio-front">
                    <div class="icono" aria-hidden="true">
                        <img src="{{ asset('img/limpieza.png') }}" class="icono">
                    </div>
                    <h3>Limpieza en general</h3>
                </div>
                <div class="servicio-back">
                    <h3>Limpieza en general</h3>
                    <p>Limpieza detallada para oficinas, hogares y negocios.</p>
                    <a href="{{ url('/servicios/limpieza') }}" class="btn-more">Ver más</a>
                </div>
            </div>
        </article>

        <article class="servicio-flip">
            <div class="servicio-inner">
                <div class="servicio-front">
                    <div class="icono" aria-hidden="true">
                        <img src="{{ asset('img/mantenimiento.png') }}" class="icono">
                    </div>
                    <h3>Mantenimiento en general</h3>
                </div>
                <div class="servicio-back">
                    <h3>Mantenimiento en general</h3>
                    <p>Cambios de luminarias, instalaciones menores, resanes y pintura.</p>
                    <a href="{{ url('/servicios/mantenimiento') }}" class="btn-more">Ver más</a>
                </div>
            </div>
        </article>

        <article class="servicio-flip">
            <div class="servicio-inner">
                <div class="servicio-front">
                    <div class="icono" aria-hidden="true"> 
                        <img src="{{ asset('img/pesticida.png') }}" class="icono"> 
                    </div>
                    <h3>Venta de equipos y refacciones</h3>
                </div>
                <div class="servicio-back">
                    <h3>Venta de equipos y refacciones</h3>
                    <p>Equipos de fumigación y desinfección con refacciones originales.</p>
                    <a href="{{ url('/servicios/venta') }}" class="btn-more">Ver más</a>
                </div>
            </div>
        </article>

        <article class="servicio-flip">
            <div class="servicio-inner">
                <div class="servicio-front">
                    <div class="icono" aria-hidden="true">
                        <img src="{{ asset('img/soporte.png') }}" class="icono">
                    </div>
                    <h3>Reparación de equipos</h3>
                </div>
                <div class="servicio-back">
                    <h3>Reparación de equipos</h3>
                    <p>Servicio técnico especializado con refacciones originales.</p>
                    <a href="{{ url('/servicios/reparacion') }}" class="btn-more">Ver más</a>
                </div>
            </div>
        </article>
    </section>
@endsection