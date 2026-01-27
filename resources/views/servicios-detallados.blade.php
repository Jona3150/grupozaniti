@extends('layouts.app')

{{-- El título se recibe dinámicamente desde el controlador a través de $info --}}
@section('title', $info['titulo'] . ' | Zaniti')

@section('content')
  <main>
    {{-- Hero dinámico --}}
    <section class="service-detail-hero">
      <img src="{{ asset($info['hero']) }}" alt="{{ $info['titulo'] }}" class="service-hero-img"/>
    </section>

    <section class="service-content">
      <div class="service-info-grid">
        <div class="service-description">
          <h2>{{ $info['titulo'] }}</h2>
          <p>{{ $info['descripcion'] }}</p>

          <h3>¿Qué incluye nuestro servicio?</h3>
          <ul>
            {{-- Iteramos sobre el array de beneficios enviado por el controlador --}}
            @foreach($info['incluye'] as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ul>
          
          <p>En <strong>Zaniti</strong>, nuestro equipo de expertos está altamente capacitado para ofrecerte un servicio de calidad, garantizando un ambiente limpio y seguro bajo los más altos estándares profesionales.</p>
        </div>
        
        <div class="call-to-action-card">
          <h3>¡Solicita tu cotización ahora!</h3>
          <p>Obtén un presupuesto personalizado y detallado para el servicio de {{ $info['titulo'] }}.</p>
          <a href="{{ url('/cotizacion') }}" class="btn-primary">Solicitar cotización</a>
        </div>
      </div>
      
      {{-- Galería estática (puedes hacerla dinámica después) --}}
      <div class="service-gallery">
        <h3>Galería del servicio</h3>
        <div class="gallery-grid">
          <img src="{{ asset('img/foto3.jpg') }}" alt="Galería Zaniti 1"/>
          <img src="{{ asset('img/foto4.jpg') }}" alt="Galería Zaniti 2"/>
          <img src="{{ asset('img/foto5.jpg') }}" alt="Galería Zaniti 3"/>
        </div>
      </div>
    </section>
  </main>
@endsection