@extends('layouts.app')

@section('title', $info['titulo'] . ' | Zaniti')

@section('content')
<main class="service-page">
  <style>
    .service-page {
      --zaniti-primary: #88E6ED;
      --zaniti-primary-strong: #6EDFE7;
      --zaniti-primary-soft: #DDF9FB;
      --zaniti-ink: #111111;
      --zaniti-ink-soft: #2B2B35;
      --zaniti-muted: #5E6470;
      --zaniti-surface: rgba(255, 255, 255, 0.94);
      --zaniti-surface-solid: #ffffff;
      --zaniti-surface-2: #F7F8FA;
      --zaniti-bg: linear-gradient(180deg, #F2F4F7 0%, #EEF3F5 100%);
      --zaniti-border: rgba(17, 17, 17, 0.08);
      --zaniti-shadow: 0 22px 60px rgba(17, 17, 17, 0.10);
      --zaniti-shadow-soft: 0 10px 30px rgba(17, 17, 17, 0.07);
      --zaniti-radius-xl: 30px;
      --zaniti-radius-lg: 22px;
      --zaniti-radius-md: 16px;

      background: var(--zaniti-bg);
      color: var(--zaniti-ink);
      padding-bottom: 3rem;
    }

    .service-page * {
      box-sizing: border-box;
    }

    .service-detail-hero {
      position: relative;
      width: min(1280px, calc(100% - 2rem));
      height: clamp(320px, 55vh, 540px);
      margin: 1.25rem auto 0;
      border-radius: 32px;
      overflow: hidden;
      box-shadow: var(--zaniti-shadow);
      background: #e9eef1;
    }

    .service-hero-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .service-detail-hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background:
        linear-gradient(180deg, rgba(17, 17, 17, 0.10) 0%, rgba(17, 17, 17, 0.62) 100%);
    }

    .hero-overlay {
      position: absolute;
      inset: auto 0 0 0;
      z-index: 2;
      padding: clamp(1.25rem, 3vw, 2.2rem);
      color: #ffffff;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.55rem 0.9rem;
      border-radius: 999px;
      background: rgba(136, 230, 237, 0.22);
      backdrop-filter: blur(8px);
      color: #ffffff;
      font-size: 0.82rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 0.9rem;
    }

    .hero-overlay h1 {
      margin: 0;
      font-size: clamp(2rem, 4.5vw, 3.5rem);
      line-height: 1.05;
      letter-spacing: -0.03em;
      max-width: 12ch;
    }

    .service-content {
      width: min(1280px, calc(100% - 2rem));
      margin: 1.5rem auto 0;
    }

    .service-info-grid {
      display: grid;
      grid-template-columns: minmax(0, 1.55fr) minmax(320px, 0.78fr);
      gap: 1.4rem;
      align-items: start;
    }

    .service-description,
    .call-to-action-card,
    .service-gallery {
      background: var(--zaniti-surface);
      border: 1px solid var(--zaniti-border);
      border-radius: var(--zaniti-radius-xl);
      box-shadow: var(--zaniti-shadow);
      backdrop-filter: blur(10px);
    }

    .service-description {
      padding: clamp(1.35rem, 3vw, 2.2rem);
    }

    .section-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.55rem 0.9rem;
      border-radius: 999px;
      background: rgba(136, 230, 237, 0.18);
      color: var(--zaniti-ink);
      font-size: 0.82rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 0.9rem;
    }

    .service-description h2 {
      margin: 0 0 0.8rem;
      font-size: clamp(1.8rem, 3vw, 2.5rem);
      line-height: 1.08;
      color: var(--zaniti-ink);
    }

    .service-description p {
      margin: 0 0 1rem;
      color: var(--zaniti-muted);
      line-height: 1.85;
      font-size: 1rem;
      max-width: 70ch;
    }

    .service-description h3 {
      margin: 1.5rem 0 1rem;
      font-size: 1.3rem;
      color: var(--zaniti-ink);
    }

    .service-description ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: grid;
      gap: 0.85rem;
    }

    .service-description ul li {
      position: relative;
      padding: 0.95rem 1rem 0.95rem 3rem;
      border-radius: 18px;
      background: var(--zaniti-surface-solid);
      border: 1px solid rgba(17, 17, 17, 0.06);
      color: var(--zaniti-ink-soft);
      line-height: 1.7;
      box-shadow: var(--zaniti-shadow-soft);
    }

    .service-description ul li::before {
      content: "✓";
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      width: 28px;
      height: 28px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 999px;
      background: rgba(136, 230, 237, 0.30);
      color: var(--zaniti-ink);
      font-weight: 800;
      font-size: 0.9rem;
    }

    .service-highlight {
      margin-top: 1.3rem;
      padding: 1.1rem 1.2rem;
      border-radius: 20px;
      background: linear-gradient(180deg, rgba(221, 249, 251, 0.72) 0%, rgba(255, 255, 255, 0.98) 100%);
      border: 1px solid rgba(110, 223, 231, 0.35);
      color: var(--zaniti-ink-soft);
      line-height: 1.8;
    }

    .service-highlight strong {
      color: var(--zaniti-ink);
    }

    .call-to-action-card {
      position: sticky;
      top: 110px;
      padding: 1.4rem;
      overflow: hidden;
    }

    .call-to-action-card::before {
      content: "";
      position: absolute;
      inset: 0 0 auto 0;
      height: 6px;
      background: linear-gradient(90deg, var(--zaniti-primary) 0%, var(--zaniti-primary-strong) 100%);
    }

    .call-to-action-card h3 {
      margin: 0 0 0.8rem;
      font-size: 1.35rem;
      line-height: 1.2;
      color: var(--zaniti-ink);
    }

    .call-to-action-card p {
      margin: 0 0 1.1rem;
      color: var(--zaniti-muted);
      line-height: 1.75;
      font-size: 0.97rem;
    }

    .service-mini-points {
      display: grid;
      gap: 0.75rem;
      margin-bottom: 1.2rem;
    }

    .service-mini-point {
      display: flex;
      gap: 0.7rem;
      align-items: flex-start;
      padding: 0.9rem;
      border-radius: 16px;
      background: var(--zaniti-surface-2);
      border: 1px solid rgba(17, 17, 17, 0.05);
      color: var(--zaniti-ink-soft);
      line-height: 1.6;
      font-size: 0.94rem;
    }

    .service-mini-point span {
      width: 34px;
      height: 34px;
      flex: 0 0 34px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 12px;
      background: rgba(136, 230, 237, 0.28);
      color: var(--zaniti-ink);
      font-weight: 800;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      min-height: 54px;
      padding: 1rem 1.2rem;
      border-radius: 18px;
      background: linear-gradient(135deg, var(--zaniti-primary) 0%, var(--zaniti-primary-strong) 100%);
      color: var(--zaniti-ink);
      text-decoration: none;
      font-size: 1rem;
      font-weight: 800;
      letter-spacing: 0.01em;
      box-shadow: 0 16px 35px rgba(110, 223, 231, 0.30);
      transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 18px 38px rgba(110, 223, 231, 0.38);
      filter: brightness(0.98);
    }

    .service-gallery {
      margin-top: 1.5rem;
      padding: clamp(1.25rem, 3vw, 2rem);
    }

    .service-gallery h3 {
      margin: 0 0 1rem;
      font-size: 1.4rem;
      color: var(--zaniti-ink);
    }

    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1rem;
    }

    .gallery-grid img {
      width: 100%;
      height: 240px;
      object-fit: cover;
      border-radius: 22px;
      box-shadow: var(--zaniti-shadow-soft);
      border: 1px solid rgba(17, 17, 17, 0.06);
      transition: transform 0.22s ease, box-shadow 0.22s ease;
      background: #ffffff;
    }

    .gallery-grid img:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 34px rgba(17, 17, 17, 0.10);
    }

    @media (max-width: 1024px) {
      .service-info-grid {
        grid-template-columns: 1fr;
      }

      .call-to-action-card {
        position: relative;
        top: 0;
      }

      .gallery-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 768px) {
      .service-page {
        padding-bottom: 2rem;
      }

      .service-detail-hero,
      .service-content {
        width: calc(100% - 1.2rem);
      }

      .service-detail-hero {
        margin-top: 0.6rem;
        border-radius: 24px;
        height: 300px;
      }

      .service-description,
      .call-to-action-card,
      .service-gallery {
        border-radius: 22px;
      }

      .service-description,
      .call-to-action-card,
      .service-gallery {
        padding: 1.05rem;
      }

      .gallery-grid {
        grid-template-columns: 1fr;
      }

      .gallery-grid img {
        height: 220px;
        border-radius: 18px;
      }
    }
  </style>

  <section class="service-detail-hero">
    <img
      src="{{ asset($info['hero']) }}"
      alt="{{ $info['titulo'] }}"
      class="service-hero-img"
    />

    <div class="hero-overlay">
      <span class="hero-badge">Servicio especializado</span>
      <h1>{{ $info['titulo'] }}</h1>
    </div>
  </section>

  <section class="service-content">
    <div class="service-info-grid">
      <div class="service-description">
        <span class="section-chip">Detalle del servicio</span>

        <h2>{{ $info['titulo'] }}</h2>

        <p>{{ $info['descripcion'] }}</p>

        <h3>¿Qué incluye nuestro servicio?</h3>

        <ul>
          @foreach($info['incluye'] as $item)
            <li>{{ $item }}</li>
          @endforeach
        </ul>

        <div class="service-highlight">
          En <strong>Zaniti</strong>, nuestro equipo de expertos está altamente capacitado
          para ofrecerte un servicio de calidad, garantizando un ambiente limpio
          y seguro bajo los más altos estándares profesionales.
        </div>
      </div>

      <aside class="call-to-action-card">
        <h3>¡Solicita tu cotización ahora!</h3>

        <p>
          Obtén un presupuesto personalizado y detallado para el servicio de
          <strong>{{ $info['titulo'] }}</strong>.
        </p>

        <div class="service-mini-points">
          <div class="service-mini-point">
            <span>✓</span>
            <div>Atención personalizada para tu necesidad específica.</div>
          </div>

          <div class="service-mini-point">
            <span>✓</span>
            <div>Respuesta rápida con orientación clara y profesional.</div>
          </div>

          <div class="service-mini-point">
            <span>✓</span>
            <div>Soluciones enfocadas en limpieza, seguridad y confianza.</div>
          </div>
        </div>

        <a href="{{ url('/cotizacion?servicio=' . $slug) }}" class="btn-primary">
          Solicitar cotización
        </a>
      </aside>
    </div>

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