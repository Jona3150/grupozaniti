@extends('layouts.app')

@section('title', 'Aviso de Privacidad | Zaniti')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .legal-container {
        background: #f4f7f9;
        padding: 60px 20px 80px 20px;
        font-family: 'Poppins', sans-serif;
    }
    
    .legal-card {
        max-width: 1000px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 40px;
        box-shadow: 0 30px 60px rgba(17, 17, 17, 0.08);
        overflow: hidden;
        border: 1px solid rgba(136, 230, 237, 0.3);
    }

    /* Encabezado con Logo y Título centrados y en líneas distintas */
    .legal-header {
        text-align: center;
        padding: 60px 40px 30px 40px;
        display: flex;
        flex-direction: column; /* Alinea los hijos en columna (uno abajo de otro) */
        align-items: center;    /* Centra horizontalmente */
    }

    .legal-logo-main {
        max-width: 350px;
        width: 100%;
        height: auto;
        margin-bottom: 20px; /* Espacio que simula el "punto y aparte" */
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.08));
    }

    .legal-header h1 {
        color: #111;
        font-weight: 800;
        font-size: 3rem;
        letter-spacing: -1.5px;
        margin: 0;
        line-height: 1.1;
    }

    .legal-body {
        padding: 20px 80px 60px 80px;
        color: #333;
        line-height: 1.9;
    }

    .legal-section {
        margin-bottom: 45px;
    }

    .legal-section h2 {
        color: #111;
        font-size: 1.4rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .legal-section h2 i {
        background: #88E6ED;
        color: #fff;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
    }

    .data-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .data-item {
        background: #f0fbfc;
        border: 1px solid #cceef1;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #2c5e61;
    }

    .legal-footer {
        background: #111;
        color: #fff;
        padding: 60px 40px;
        text-align: center;
    }

    .contact-button {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #88E6ED;
        color: #111;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        margin-top: 25px;
    }

    .contact-button:hover {
        background: #fff;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(136, 230, 237, 0.3);
    }

    @media (max-width: 768px) {
        .legal-body { padding: 30px 25px; }
        .legal-header h1 { font-size: 2.2rem; }
        .legal-logo-main { max-width: 250px; }
    }
</style>

<div class="legal-container">
    
    <article class="legal-card animate__animated animate__fadeInUp">
        
        <header class="legal-header">
            <img src="{{ asset('img/logobg.png') }}" alt="Zaniti Logo" class="legal-logo-main animate__animated animate__zoomIn">
            
            <h1>Aviso de Privacidad</h1>
        </header>

        <div class="legal-body">
            
            <div class="legal-section">
                <h2><i class="bi bi-building"></i> Responsable de la Información</h2>
                <p>
                    <strong>Zaniti</strong>, con ubicación oficial en <strong>Calle Melchor Ocampo No. 201, San Bernardino, 50080 Toluca de Lerdo, México</strong>, es la entidad responsable de salvaguardar la integridad y privacidad de los datos personales que usted nos proporciona a través de nuestros sistemas digitales.
                </p>
            </div>

            <div class="legal-section">
                <h2><i class="bi bi-database-fill-check"></i> Datos Sujetos a Tratamiento</h2>
                <p>Para procesar sus solicitudes de contacto y generación de presupuestos técnicos, recabamos los siguientes datos de manera directa:</p>
                <div class="data-grid">
                    <span class="data-item">Nombre del Solicitante</span>
                    <span class="data-item">Teléfono de Contacto</span>
                    <span class="data-item">Email de Respuesta</span>
                    <span class="data-item">Servicio Requerido</span>
                    <span class="data-item">Superficie Estimada (m²)</span>
                    <span class="data-item">Descripción del Servicio</span>
                    <span class="data-item">Evidencia Fotográfica de Áreas</span>
                </div>
            </div>

            <div class="legal-section">
                <h2><i class="bi bi-shield-lock-fill"></i> Finalidad de la Recolección</h2>
                <p>La información compartida tiene como único fin la operación legítima de los servicios de Zaniti:</p>
                <ul>
                    <li>Realizar diagnósticos precisos basados en las imágenes y dimensiones proporcionadas.</li>
                    <li>Emitir cotizaciones formales por servicios de desinfección, limpieza o fumigación.</li>
                    <li>Establecer canales de comunicación para la confirmación de citas en sitio y seguimiento técnico.</li>
                    <li>Garantizar la seguridad de nuestra plataforma administrativa mediante la validación de solicitudes.</li>
                </ul>
            </div>

            <div class="legal-section">
                <h2><i class="bi bi-fingerprint"></i> Sus Derechos (ARCO)</h2>
                <p>
                    Usted conserva en todo momento el control sobre su información personal. Puede ejercer sus derechos de Acceso, Rectificación, Cancelación u Oposición enviando una solicitud formal a nuestro departamento de privacidad. En Zaniti, no compartimos, vendemos ni transferimos su información con terceros ajenos a nuestra operación técnica.
                </p>
            </div>

        </div>

        <footer class="legal-footer">
            <h3>¿Deseas gestionar tu información?</h3>
            <p>Para cualquier aclaración legal o ejercicio de sus derechos, contáctanos directamente:</p>
            <a href="mailto:zaniti@outlook.com" class="contact-button">
                <i class="bi bi-send-check-fill"></i> zaniti@outlook.com
            </a>
            <p style="margin-top: 45px; font-size: 0.85rem; opacity: 0.6;">
                Zaniti © 2025 | Cumplimiento con la Ley Federal de Protección de Datos Personales (México).
            </p>
        </footer>

    </article>
</div>

<script>
    // Forzamos el scroll al inicio apenas cargue el DOM
    window.scrollTo(0, 0);

    // Como medida extra por si el navegador intenta restaurar la posición
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Aseguramos que ningún elemento (como el botón del footer) tenga el foco
        window.scrollTo({
            top: 0,
            behavior: 'instant'
        });
    });
</script>
@endsection