@extends('layouts.app')

@section('title', 'Nosotros | Zaniti - Creamos espacios limpios y seguros')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<section class="nosotros-page">
  <style>
    .nosotros-page {
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

      position: relative;
      overflow: hidden;
      padding: clamp(1.5rem, 4vw, 3.5rem) 1rem 3rem;
      background: var(--zaniti-bg);
      color: var(--zaniti-ink);
    }

    .nosotros-page * {
      box-sizing: border-box;
    }

    .nosotros-page::before,
    .nosotros-page::after {
      content: "";
      position: absolute;
      border-radius: 999px;
      pointer-events: none;
      z-index: 0;
    }

    .nosotros-page::before {
      width: 360px;
      height: 360px;
      top: -100px;
      left: -90px;
      background: radial-gradient(circle, rgba(136, 230, 237, 0.34) 0%, rgba(136, 230, 237, 0) 72%);
    }

    .nosotros-page::after {
      width: 420px;
      height: 420px;
      right: -110px;
      bottom: -140px;
      background: radial-gradient(circle, rgba(110, 223, 231, 0.24) 0%, rgba(110, 223, 231, 0) 72%);
    }

    .nosotros-shell {
      position: relative;
      z-index: 1;
      max-width: 1280px;
      margin: 0 auto;
    }

    .nosotros-hero {
      display: grid;
      grid-template-columns: 1.05fr 0.95fr;
      gap: 1.5rem;
      align-items: center;
      margin-bottom: 1.6rem;
    }

    .nosotros-content,
    .nosotros-image,
    .valor-card,
    .servicio-item {
      background: var(--zaniti-surface);
      border: 1px solid var(--zaniti-border);
      box-shadow: var(--zaniti-shadow);
      backdrop-filter: blur(10px);
    }

    .nosotros-content {
      padding: clamp(1.5rem, 3vw, 2.5rem);
      border-radius: var(--zaniti-radius-xl);
    }

    .section-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.6rem 1rem;
      margin-bottom: 1rem;
      border-radius: 999px;
      background: rgba(136, 230, 237, 0.18);
      color: var(--zaniti-ink);
      font-size: 0.84rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }

    .section-badge i {
      font-size: 0.95rem;
    }

    .nosotros-content h1 {
      margin: 0 0 0.9rem;
      font-size: clamp(2.1rem, 4vw, 3.5rem);
      line-height: 1.04;
      letter-spacing: -0.03em;
      color: var(--zaniti-ink);
    }

    .nosotros-content p {
      margin: 0 0 1rem;
      max-width: 62ch;
      font-size: 1rem;
      line-height: 1.85;
      color: var(--zaniti-muted);
    }

    .nosotros-content p:last-child {
      margin-bottom: 0;
    }

    .nosotros-highlights {
      display: flex;
      flex-wrap: wrap;
      gap: 0.85rem;
      margin-top: 1.2rem;
    }

    .highlight-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.85rem 1rem;
      border-radius: 18px;
      background: var(--zaniti-surface-solid);
      border: 1px solid rgba(17, 17, 17, 0.06);
      color: var(--zaniti-ink-soft);
      font-size: 0.93rem;
      font-weight: 700;
      box-shadow: var(--zaniti-shadow-soft);
    }

    .highlight-chip i {
      color: var(--zaniti-ink);
    }

    .nosotros-image {
      border-radius: var(--zaniti-radius-xl);
      overflow: hidden;
      min-height: 100%;
      position: relative;
    }

    .nosotros-image::after {
      content: "";
      position: absolute;
      inset: auto 0 0 0;
      height: 40%;
     
      pointer-events: none;
    }

    .equipo-foto {
      display: block;
      width: 100%;
      height: 100%;
      min-height: 460px;
      object-fit: cover;
    }

    .nuestros-valores {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 1.25rem;
      margin-bottom: 1.6rem;
    }

    .valor-card {
      padding: 1.5rem;
      border-radius: var(--zaniti-radius-lg);
    }

    .card-icon {
      width: 58px;
      height: 58px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      border-radius: 18px;
      background: rgba(136, 230, 237, 0.24);
      color: var(--zaniti-ink);
      font-size: 1.4rem;
      box-shadow: var(--zaniti-shadow-soft);
    }

    .valor-card h3 {
      margin: 0 0 0.7rem;
      font-size: 1.35rem;
      color: var(--zaniti-ink);
    }

    .valor-card p {
      margin: 0;
      color: var(--zaniti-muted);
      line-height: 1.8;
      font-size: 0.98rem;
    }

    .nuestros-servicios-resumen {
      padding: clamp(1.5rem, 3vw, 2.4rem);
      border-radius: var(--zaniti-radius-xl);
      background: var(--zaniti-surface);
      border: 1px solid var(--zaniti-border);
      box-shadow: var(--zaniti-shadow);
      backdrop-filter: blur(10px);
    }

    .section-heading {
      max-width: 760px;
      margin-bottom: 1.35rem;
    }

    .section-heading h2 {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin: 0 0 0.65rem;
      font-size: clamp(1.75rem, 3vw, 2.5rem);
      line-height: 1.1;
      color: var(--zaniti-ink);
    }

    .section-heading h2 i {
      width: 46px;
      height: 46px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 15px;
      background: rgba(136, 230, 237, 0.22);
      font-size: 1.15rem;
    }

    .section-heading p {
      margin: 0;
      color: var(--zaniti-muted);
      line-height: 1.8;
      font-size: 1rem;
    }

    .servicio-list-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 1.1rem;
    }

    .servicio-item {
      padding: 1.35rem;
      border-radius: var(--zaniti-radius-lg);
      background: rgba(255, 255, 255, 0.95);
      transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
    }

    .servicio-item:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 34px rgba(17, 17, 17, 0.10);
      border-color: rgba(110, 223, 231, 0.55);
    }

    .servicio-top {
      display: flex;
      align-items: center;
      gap: 0.8rem;
      margin-bottom: 0.85rem;
    }

    .servicio-top i {
      width: 50px;
      height: 50px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 16px;
      background: rgba(136, 230, 237, 0.22);
      color: var(--zaniti-ink);
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .servicio-item h4 {
      margin: 0;
      font-size: 1.05rem;
      line-height: 1.35;
      color: var(--zaniti-ink);
    }

    .servicio-item p {
      margin: 0;
      color: var(--zaniti-muted);
      line-height: 1.75;
      font-size: 0.96rem;
    }

    @media (max-width: 1024px) {
      .nosotros-hero,
      .servicio-list-grid {
        grid-template-columns: 1fr;
      }

      .equipo-foto {
        min-height: 360px;
      }
    }

    @media (max-width: 768px) {
      .nosotros-page {
        padding: 1rem 0.85rem 2rem;
      }

      .nosotros-hero,
      .nuestros-valores {
        grid-template-columns: 1fr;
      }

      .nosotros-content,
      .nosotros-image,
      .nuestros-servicios-resumen,
      .valor-card,
      .servicio-item {
        border-radius: 22px;
      }

      .nosotros-content,
      .nuestros-servicios-resumen,
      .valor-card,
      .servicio-item {
        padding: 1.1rem;
      }

      .equipo-foto {
        min-height: 300px;
      }

      .section-heading h2 {
        align-items: flex-start;
      }
    }
  </style>

  <div class="nosotros-shell">
    <section class="nosotros-hero">
      <div class="nosotros-content">
        <span class="section-badge">
          <i class="bi bi-buildings"></i>
          Sobre Zaniti
        </span>

        <h1>Conoce a Zaniti</h1>

        <p>Somos una empresa mexicana enfocada en crear espacios limpios y seguros, protegiendo a las personas que más quieres mediante soluciones innovadoras de sanitización, control de plagas y mantenimiento integral.</p>

        <p>Nos caracterizamos por el trato personalizado y por buscar siempre la mejor solución para tus necesidades, garantizando calidad, precio y puntualidad en cada servicio.</p>

        <div class="nosotros-highlights">
          <span class="highlight-chip">
            <i class="bi bi-shield-check"></i>
            Espacios protegidos
          </span>
          <span class="highlight-chip">
            <i class="bi bi-stars"></i>
            Atención personalizada
          </span>
          <span class="highlight-chip">
            <i class="bi bi-clock-history"></i>
            Calidad y puntualidad
          </span>
        </div>
      </div>

      <div class="nosotros-image">
        <img src="{{ asset('img/fondo.jpg') }}" alt="Equipo de Zaniti" class="equipo-foto">
      </div>
    </section>

    <section class="nuestros-valores">
      <div class="valor-card">
        <span class="card-icon">
          <i class="bi bi-bullseye"></i>
        </span>
        <h3>Misión y Enfoque</h3>
        <p>Cuidar de tus espacios y proteger a las personas promoviendo soluciones profesionales y personalizadas de limpieza, desinfección y control de plagas.</p>
      </div>

      <div class="valor-card">
        <span class="card-icon">
          <i class="bi bi-people"></i>
        </span>
        <h3>Nuestro Compromiso</h3>
        <p>Trabajamos de la mano contigo, ofreciendo siempre un trato personalizado y buscando la mejor solución para tus necesidades, teniendo en cuenta la calidad, el precio y la puntualidad.</p>
      </div>
    </section>

    <section class="nuestros-servicios-resumen">
      <div class="section-heading">
        <h2>
          <i class="bi bi-grid-1x2"></i>
          Nuestros Servicios Integrales
        </h2>
        <p>Ofrecemos una cadena de servicios que van de la mano para un control total de higiene:</p>
      </div>

      <div class="servicio-list-grid">
        <div class="servicio-item">
          <div class="servicio-top">
            <i class="bi bi-bug"></i>
            <h4>Control y Prevención de Plagas</h4>
          </div>
          <p>Diagnóstico, aplicación y seguimiento con productos 100% originales para controlar y eliminar el problema.</p>
        </div>

        <div class="servicio-item">
          <div class="servicio-top">
            <i class="bi bi-droplet-half"></i>
            <h4>Desinfección (Sanitización) y Limpieza</h4>
          </div>
          <p>Procesos meticulosos con productos biodegradables y amigables con mascotas, usando aspersión, termonebulización y procesos manuales.</p>
        </div>

        <div class="servicio-item">
          <div class="servicio-top">
            <i class="bi bi-tools"></i>
            <h4>Mantenimiento y Equipos</h4>
          </div>
          <p>Servicios de mantenimiento básico (cambio de focos, pintura, etc.), además de venta y reparación de equipos de aspersión y termonebulización con refacciones originales.</p>
        </div>
      </div>
    </section>
  </div>
</section>
@endsection