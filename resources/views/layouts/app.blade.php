<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Zaniti')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/zaniticss.css') }}"/>
</head>
<body>
 <header>
    <div class="brand">
        <img src="{{ asset('img/logo.jpg') }}" alt="Zaniti" class="logo"/>
        <div class="brand-text">
            <span class="logo-text">Creamos espacios limpios y seguros</span>
        </div>
    </div>

    <button class="menu-toggle" id="mobile-menu-btn" aria-label="Abrir menú">
        <span class="hamburger"></span>
    </button>

    <nav class="desktop-nav">
        <ul>
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/#servicios') }}">Servicios</a></li>
            <li><a href="{{ url('/contacto') }}">Contacto</a></li>
            <li><a href="{{ url('/nosotros') }}">Conocenos</a></li>
        </ul>
    </nav>

    <nav class="mobile-nav" id="mobile-nav">
        <ul>
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ url('/#servicios') }}">Servicios</a></li>
            <li><a href="{{ url('/contacto') }}">Contacto</a></li>
            <li><a href="{{ url('/nosotros') }}">Conocenos</a></li>
        </ul>
    </nav>
</header>

  <main>
    @yield('content')
  </main>

  <footer>
    <p>© 2025 Zaniti. Todos los derechos reservados.</p>
    <p><a href="tel:+527228966796">+52 722 896 6796</a> · <a href="mailto:grupozaniti@gmail.com">grupozaniti@gmail.com</a></p>
  
  
    <a href="javascript:void(0)" onclick="resetCookies()">Configuración de Cookies</a> |
<a href="{{ url('/aviso-privacidad') }}">Aviso de Privacidad</a>
  </footer>

  <script src="{{ asset('js/carousel.js') }}"></script>
  @yield('scripts')

<div id="cookie-banner" class="cookie-sticky-banner animate__animated animate__fadeInUp" style="display: none;">
    <div class="cookie-wrapper">
        <div class="cookie-info">
            <div class="cookie-icon-circle">
                <i class="fas fa-cookie-bite"></i>
            </div>
            <p>
                <strong>Configuración de Cookies:</strong> 
                Usamos cookies para que  <strong>Zaniti</strong> funcione correctamente. 
                Al navegar, aceptas su uso.
            </p>
        </div>
        <div class="cookie-actions">
            <button id="accept-cookies" class="btn-cyan-zaniti">
                <i class="fas fa-check mr-2"></i> Entendido
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const banner = document.getElementById('cookie-banner');
    const btn = document.getElementById('accept-cookies');

    // 1. Pequeño retraso para evitar conflictos de carga (500ms)
    setTimeout(() => {
        const hasConsented = localStorage.getItem('zaniti_cookies_accepted');
        
        
        if (!hasConsented || hasConsented !== 'true') {
            banner.style.setProperty('display', 'block', 'important');
            console.log("Banner de cookies activado");
        }
    }, 500);

    // 2. Evento de clic
    btn.addEventListener('click', function(e) {
        e.preventDefault(); // Evitamos cualquier acción por defecto
        
        // Guardar la decisión de forma explícita
        localStorage.setItem('zaniti_cookies_accepted', 'true');
        
        // Animación de salida
        banner.classList.remove('animate__fadeInUp');
        banner.classList.add('animate__fadeOutDown');
        
        // Ocultar después de la animación
        setTimeout(() => {
            banner.style.setProperty('display', 'none', 'important');
        }, 600);
    });
});

// Función de reset mejorada para pruebas
function resetCookies() {
    localStorage.clear();
    location.reload();
}
</script>

</body>
</html>