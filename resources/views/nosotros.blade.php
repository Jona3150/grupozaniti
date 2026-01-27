@extends('layouts.app')

@section('title', 'Nosotros | Zaniti - Creamos espacios limpios y seguros')

@section('content')
  <section class="nosotros-hero">
    <div class="nosotros-content">
      <h1>Conoce a Zaniti</h1>
      <p>Somos una empresa mexicana enfocada en crear espacios limpios y seguros, protegiendo a las personas que más quieres mediante soluciones innovadoras de sanitización, control de plagas y mantenimiento integral.</p>
      <p>Nos caracterizamos por el trato personalizado y por buscar siempre la mejor solución para tus necesidades, garantizando calidad, precio y puntualidad en cada servicio.</p>
    </div>
    <div class="nosotros-image">
      <img src="{{ asset('img/foto7.jpg') }}" alt="Equipo de Zaniti" class="equipo-foto">
    </div>
  </section>

  <section class="nuestros-valores">
    <div class="valor-card">
      <h3>Misión y Enfoque</h3>
      <p>Cuidar de tus espacios y proteger a las personas promoviendo soluciones profesionales y personalizadas de limpieza, desinfección y control de plagas.</p>
    </div>
    <div class="valor-card">
      <h3>Nuestro Compromiso</h3>
      <p>Trabajamos de la mano contigo, ofreciendo siempre un trato personalizado y buscando la mejor solución para tus necesidades, teniendo en cuenta la calidad, el precio y la puntualidad.</p>
    </div>
  </section>
  
  <section class="nuestros-servicios-resumen">
    <h2>Nuestros Servicios Integrales</h2>
    <p>Ofrecemos una cadena de servicios que van de la mano para un control total de higiene:</p>
    <div class="servicio-list-grid">
      <div class="servicio-item">
        <h4>Control y Prevención de Plagas</h4>
        <p>Diagnóstico, aplicación y seguimiento con productos 100% originales para controlar y eliminar el problema.</p>
      </div>
      <div class="servicio-item">
        <h4>Desinfección (Sanitización) y Limpieza</h4>
        <p>Procesos meticulosos con productos biodegradables y amigables con mascotas, usando aspersión, termonebulización y procesos manuales.</p>
      </div>
      <div class="servicio-item">
        <h4>Mantenimiento y Equipos</h4>
        <p>Servicios de mantenimiento básico (cambio de focos, pintura, etc.), además de venta y reparación de equipos de aspersión y termonebulización con refacciones originales.</p>
      </div>
    </div>
  </section>
@endsection