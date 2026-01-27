<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Zaniti')</title>

  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/zaniticss.css') }}"/>
</head>
<body>
  <header>
    <div class="brand">
      <img src="{{ asset('img/logo.jpg') }}" alt="Zaniti" class="logo"/>
      <div class="brand-text"><span class="logo-text">Creamos espacios limpios y seguros</span></div>
    </div>
    <nav class="desktop-nav">
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
  </footer>

  <script src="{{ asset('js/carousel.js') }}"></script>
  @yield('scripts')
</body>
</html>