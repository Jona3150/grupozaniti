@extends('layouts.app')

{{-- El título se recibe dinámicamente desde el controlador --}}
@section('title', $info['titulo'] . ' | Zaniti')

@section('content')
<main>

  {{-- Hero dinámico --}}
  <section class="service-detail-hero">
    <img src="{{ asset($info['hero']) }}" 
         alt="{{ $info['titulo'] }}" 
         class="service-hero-img"/>
  </section>


  <section class="service-content">

    <div class="service-info-grid">

      {{-- Descripción del servicio --}}
      <div class="service-description">

        <h2>{{ $info['titulo'] }}</h2>

        <p>{{ $info['descripcion'] }}</p>


        <h3>¿Qué incluye nuestro servicio?</h3>

        <ul>
          @foreach($info['incluye'] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>


        <p>
        En <strong>Zaniti</strong>, nuestro equipo de expertos está altamente capacitado
        para ofrecerte un servicio de calidad, garantizando un ambiente limpio
        y seguro bajo los más altos estándares profesionales.
        </p>

      </div>


      {{-- Tarjeta de cotización --}}
      <div class="call-to-action-card">

        <h3>¡Solicita tu cotización ahora!</h3>

        <p>
        Obtén un presupuesto personalizado y detallado para el servicio de
        {{ $info['titulo'] }}.
        </p>

        <a href="{{ url('/cotizacion') }}" class="btn-primary">
          Solicitar cotización
        </a>

      </div>

    </div>



    {{-- Galería dinámica --}}
    <div class="service-gallery">

      <h3>Galería del servicio</h3>

      <div class="gallery-grid">

        @if(isset($info['galeria']))
          @foreach($info['galeria'] as $foto)

            <img 
              src="{{ asset($foto) }}" 
              alt="Imagen de {{ $info['titulo'] }}"
            >

          @endforeach
        @endif

      </div>

    </div>

  </section>

</main>
@endsection