@extends('layouts.app')

@section('title', 'Contacto | Zaniti - Soluciones Profesionales')

@section('content')
<section class="contacto-content">
    <h1>Contáctanos</h1>
    <p>Estamos listos para ayudarte a mantener tus espacios limpios y seguros. ¡Envíanos un mensaje!</p>

    {{-- Mensaje de éxito al enviar el formulario --}}
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 1.2rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; border: 1px solid #c3e6cb;">
            <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    <div class="contacto-grid">
        <div class="formulario-card">
            <form id="contactForm" method="POST" action="{{ route('contacto.enviar') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <small style="color: #e3342f; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <small style="color: #e3342f; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                    @error('message')
                        <small style="color: #e3342f; display: block; margin-top: 5px;">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Enviar mensaje</button>
            </form>
        </div>

        <div class="mapa-card">
            <h3>Nuestra ubicación</h3>
            <div id="map-container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d941.4026417195253!2d-99.71087813043152!3d19.299294398871993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd881aec291739%3A0x9f53dc1851021f2!2sZaniti!5e0!3m2!1ses-419!2smx!4v1773733570284!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div class="info-contacto">
                <p><strong>Dirección:</strong> Av. Altamirano Manzana 053, Las Culturas, 51355 San Luis Mextepec, Méx.</p>
                <p><strong>Teléfono:</strong> <a href="tel:+527228966796" style="color: inherit; text-decoration: none;">+52 722 896 6796</a></p>
                <p><strong>Correo:</strong> <a href="mailto:grupozaniti@gmail.com" style="color: inherit; text-decoration: none;">grupozaniti@gmail.com</a></p>
            </div>

            <div class="redes-sociales">
                <a href="https://www.facebook.com/grupozaniti" target="_blank" aria-label="Facebook">
                    <img src="{{ asset('img/facebook-icon.png') }}" alt="Facebook Zaniti">
                </a>
                <a href="https://wa.me/527228966796" target="_blank" aria-label="WhatsApp">
                    <img src="{{ asset('img/whatsapp-icon.png') }}" alt="WhatsApp Zaniti">
                </a>
            </div>
        </div>
    </div>
</section>
@endsection