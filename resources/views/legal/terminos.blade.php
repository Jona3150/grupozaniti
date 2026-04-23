@extends('layouts.app')

@section('title', 'Términos y Condiciones | Zaniti')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .legal-container { background: #f4f7f9; padding: 60px 20px 80px 20px; font-family: 'Poppins', sans-serif; }
    .legal-card { max-width: 1000px; margin: 0 auto; background: #ffffff; border-radius: 40px; box-shadow: 0 30px 60px rgba(17,17,17,0.08); overflow: hidden; border: 1px solid rgba(136, 230, 237, 0.3); }
    .legal-header { text-align: center; padding: 60px 40px 30px 40px; display: flex; flex-direction: column; align-items: center; }
    .legal-logo-main { max-width: 350px; width: 100%; margin-bottom: 20px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.08)); }
    .legal-header h1 { color: #111; font-weight: 800; font-size: 3rem; letter-spacing: -1.5px; margin: 0; line-height: 1.1; }
    .legal-body { padding: 20px 80px 60px 80px; color: #333; line-height: 1.9; }
    .legal-section { margin-bottom: 45px; }
    .legal-section h2 { color: #111; font-size: 1.4rem; font-weight: 700; display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
    .legal-section h2 i { background: #88E6ED; color: #fff; width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; border-radius: 12px; font-size: 1.2rem; }
    .legal-footer { background: #111; color: #fff; padding: 60px 40px; text-align: center; }
</style>

<div class="legal-container">
    <article class="legal-card animate__animated animate__fadeInUp">
        <header class="legal-header">
            <img src="{{ asset('img/logobg.png') }}" alt="Zaniti Logo" class="legal-logo-main animate__animated animate__zoomIn">
            <h1>Términos y Condiciones</h1>
        </header>

        <div class="legal-body">
            <div class="legal-section">
                <h2><i class="bi bi-shield-lock-fill"></i> 1. Propiedad del Sistema</h2>
                <p>El presente Panel Administrativo es propiedad exclusiva de <strong>Zaniti</strong>. Su software, código fuente, interfaz gráfica y algoritmos de gestión de inventario y calendario están protegidos por leyes de propiedad intelectual. Queda prohibida cualquier reproducción o ingeniería inversa.</p>
            </div>

            <div class="legal-section">
                <h2><i class="bi bi-calendar-check-fill"></i> 2. Gestión de Servicios y Calendario</h2>
                <p>La información vertida en el <strong>Calendario de Servicios</strong> tiene fines de organización operativa interna. Zaniti no se hace responsable por cambios de programación derivados de fallos técnicos externos o información incorrecta proporcionada en los registros de clientes.</p>
            </div>

            <div class="legal-section">
                <h2><i class="bi bi-box-seam-fill"></i> 3. Control de Inventario y Stock</h2>
                <p>Los datos registrados en el <strong>Control de Inventario</strong> (químicos, insecticidas y equipos) son responsabilidad del usuario administrador. Zaniti deslinda responsabilidad por alertas de stock no atendidas o variaciones en el valor de almacén por errores de captura manual.</p>
            </div>

            <div class="legal-section">
                <h2><i class="bi bi-people-fill"></i> 4. Confidencialidad del Directorio</h2>
                <p>El <strong>Directorio de Clientes</strong> contiene datos sensibles. Queda estrictamente prohibida la transferencia o uso de esta información fuera de los fines operativos de fumigación y limpieza de la empresa, bajo pena de las sanciones legales correspondientes.</p>
            </div>
        </div>

        <footer class="legal-footer">
            <p>Zaniti © 2025 | Uso Administrativo Privado</p>
            <p style="margin-top: 20px; font-size: 0.85rem; opacity: 0.6;">Última actualización: Abril 2024 | Toluca, México.</p>
        </footer>
    </article>
</div>

<script>
    window.scrollTo(0, 0);
    if ('scrollRestoration' in history) { history.scrollRestoration = 'manual'; }
</script>
@endsection