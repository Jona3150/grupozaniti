@extends('layouts.app')

@section('title', 'Contacto | Zaniti - Soluciones Profesionales')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<section class="contacto-section">
    <style>
        .contacto-section {
            --zaniti-primary: #88E6ED;
            --zaniti-primary-strong: #6EDFE7;
            --zaniti-primary-soft: #DDF9FB;
            --zaniti-ink: #111111;
            --zaniti-ink-soft: #2B2B35;
            --zaniti-muted: #5E6470;
            --zaniti-surface: rgba(255, 255, 255, 0.94);
            --zaniti-surface-2: #F7F8FA;
            --zaniti-bg: linear-gradient(180deg, #F2F4F7 0%, #EEF3F5 100%);
            --zaniti-border: rgba(17, 17, 17, 0.08);
            --zaniti-shadow: 0 22px 60px rgba(17, 17, 17, 0.10);
            --zaniti-shadow-soft: 0 10px 30px rgba(17, 17, 17, 0.07);
            --zaniti-success-bg: #ECFDF5;
            --zaniti-success-border: #A7F3D0;
            --zaniti-success-text: #065F46;
            --zaniti-error: #DC2626;
            --zaniti-radius-xl: 28px;
            --zaniti-radius-lg: 22px;
            --zaniti-radius-md: 16px;
        }

        .contacto-section {
            position: relative;
            overflow: hidden;
            padding: clamp(1.5rem, 4vw, 3rem) 1rem;
            background: var(--zaniti-bg);
            color: var(--zaniti-ink);
        }

        .contacto-section * {
            box-sizing: border-box;
        }

        .contacto-section::before,
        .contacto-section::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            z-index: 0;
        }

        .contacto-section::before {
            width: 360px;
            height: 360px;
            top: -120px;
            left: -90px;
            background: radial-gradient(circle, rgba(136, 230, 237, 0.35) 0%, rgba(136, 230, 237, 0) 72%);
        }

        .contacto-section::after {
            width: 420px;
            height: 420px;
            right: -100px;
            bottom: -120px;
            background: radial-gradient(circle, rgba(110, 223, 231, 0.24) 0%, rgba(110, 223, 231, 0) 72%);
        }

        .contacto-shell {
            position: relative;
            z-index: 1;
            max-width: 1380px;
            margin: 0 auto;
        }

        .contacto-grid {
            display: grid;
            grid-template-columns: minmax(320px, 430px) minmax(0, 1fr);
            gap: 1.5rem;
            align-items: stretch;
        }

        .formulario-card,
        .mapa-card {
            background: var(--zaniti-surface);
            border: 1px solid var(--zaniti-border);
            border-radius: var(--zaniti-radius-xl);
            box-shadow: var(--zaniti-shadow);
            backdrop-filter: blur(10px);
        }

        .formulario-card {
            padding: clamp(1.2rem, 2vw, 2rem);
        }

        .card-header {
            margin-bottom: 1.35rem;
        }

        .card-eyebrow {
            display: inline-block;
            margin-bottom: 0.55rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(136, 230, 237, 0.18);
            color: var(--zaniti-ink);
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .card-title {
            margin: 0 0 0.5rem;
            font-size: clamp(1.45rem, 2vw, 2rem);
            line-height: 1.15;
            color: var(--zaniti-ink);
        }

        .card-description {
            margin: 0;
            color: var(--zaniti-muted);
            line-height: 1.7;
            font-size: 0.97rem;
        }

        .contacto-success {
            display: flex;
            gap: 0.8rem;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding: 1rem 1.1rem;
            border-radius: var(--zaniti-radius-md);
            border: 1px solid var(--zaniti-success-border);
            background: var(--zaniti-success-bg);
            color: var(--zaniti-success-text);
        }

        .contacto-success-icon {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(136, 230, 237, 0.25);
            color: var(--zaniti-ink);
            font-size: 1.15rem;
        }

        .contact-form {
            display: grid;
            gap: 1rem;
        }

        .form-group {
            display: grid;
            gap: 0.5rem;
        }

        .form-group label {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--zaniti-ink);
        }

        .form-group label i {
            color: var(--zaniti-ink-soft);
            font-size: 0.95rem;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            border: 1px solid rgba(17, 17, 17, 0.10);
            background: #FFFFFF;
            color: var(--zaniti-ink);
            border-radius: 16px;
            padding: 0.95rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            outline: none;
            transition: border-color 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
        }

        .contact-form input::placeholder,
        .contact-form textarea::placeholder {
            color: #8B93A1;
        }

        .contact-form textarea {
            min-height: 170px;
            resize: vertical;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            background: #ffffff;
            border-color: rgba(110, 223, 231, 0.95);
            box-shadow: 0 0 0 4px rgba(136, 230, 237, 0.28);
        }

        .field-error,
        .server-error {
            font-size: 0.88rem;
            line-height: 1.5;
            color: var(--zaniti-error) !important;
        }

        .server-error {
            display: block;
            margin-top: 0.1rem;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            width: 100%;
            min-height: 54px;
            margin-top: 0.35rem;
            padding: 1rem 1.2rem;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--zaniti-primary) 0%, var(--zaniti-primary-strong) 100%);
            color: var(--zaniti-ink);
            font-size: 1rem;
            font-weight: 800;
            box-shadow: 0 16px 35px rgba(110, 223, 231, 0.30);
            cursor: pointer;
            transition: transform 0.22s ease, box-shadow 0.22s ease, opacity 0.22s ease, filter 0.22s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(110, 223, 231, 0.38);
            filter: brightness(0.98);
        }

        .btn-submit-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .mapa-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-height: 78vh;
        }

        .mapa-header {
            padding: 1.35rem 1.35rem 1rem;
            border-bottom: 1px solid rgba(17, 17, 17, 0.06);
            background: linear-gradient(180deg, rgba(136, 230, 237, 0.18) 0%, rgba(255, 255, 255, 0.96) 100%);
        }

        .mapa-header h3 {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin: 0 0 0.4rem;
            font-size: 1.35rem;
            color: var(--zaniti-ink);
        }

        .mapa-header h3 i {
            color: var(--zaniti-ink-soft);
        }

        .mapa-header p {
            margin: 0;
            color: var(--zaniti-muted);
            line-height: 1.7;
            font-size: 0.96rem;
        }

        #map-container {
            padding: 1rem;
            flex: 1;
            display: flex;
        }

        #map-container iframe {
            display: block;
            width: 100%;
            min-height: 560px;
            height: 100%;
            border: 0;
            border-radius: 22px;
            box-shadow: var(--zaniti-shadow-soft);
        }

        .info-contacto {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.9rem;
            padding: 0 1rem 1rem;
        }

        .info-item {
            display: flex;
            gap: 0.8rem;
            align-items: flex-start;
            padding: 1rem;
            border-radius: 18px;
            background: var(--zaniti-surface-2);
            border: 1px solid rgba(17, 17, 17, 0.05);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(136, 230, 237, 0.28);
            color: var(--zaniti-ink);
            font-size: 1rem;
            font-weight: 700;
        }

        .info-item strong {
            display: block;
            margin-bottom: 0.2rem;
            color: var(--zaniti-ink);
            font-size: 0.94rem;
        }

        .info-item p,
        .info-item a {
            margin: 0;
            color: var(--zaniti-ink-soft);
            line-height: 1.6;
            text-decoration: none;
            word-break: break-word;
        }

        .info-item a:hover {
            color: #000000;
        }

        .redes-wrap {
            padding: 0 1rem 1rem;
        }

        .redes-header {
            margin-bottom: 0.8rem;
        }

        .redes-header strong {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--zaniti-ink);
        }

        .redes-header span {
            color: var(--zaniti-muted);
            font-size: 0.92rem;
        }

        .redes-sociales {
            display: flex;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .redes-sociales a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 18px;
            background: #FFFFFF;
            border: 1px solid rgba(17, 17, 17, 0.06);
            box-shadow: 0 8px 22px rgba(17, 17, 17, 0.05);
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, background 0.22s ease;
            color: var(--zaniti-ink);
            font-size: 1.35rem;
            text-decoration: none;
        }

        .redes-sociales a:hover {
            transform: translateY(-3px);
            border-color: rgba(110, 223, 231, 0.55);
            background: var(--zaniti-primary-soft);
            box-shadow: 0 14px 26px rgba(17, 17, 17, 0.10);
        }

        @media (max-width: 1100px) {
            .contacto-grid {
                grid-template-columns: 1fr;
            }

            .mapa-card {
                min-height: auto;
            }

            #map-container iframe {
                min-height: 480px;
            }

            .info-contacto {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .contacto-section {
                padding: 1rem 0.85rem 2rem;
            }

            .formulario-card,
            .mapa-card {
                border-radius: 22px;
            }

            .formulario-card {
                padding: 1rem;
            }

            .mapa-header,
            #map-container,
            .info-contacto,
            .redes-wrap {
                padding-left: 0.9rem;
                padding-right: 0.9rem;
            }

            #map-container iframe {
                min-height: 360px;
                border-radius: 18px;
            }
        }
    </style>

    <div class="contacto-shell">
        <div class="contacto-grid">
            <div class="formulario-card">
                <div class="card-header">
                    <span class="card-eyebrow">Formulario de contacto</span>
                    <h2 class="card-title">Envíanos un mensaje</h2>
                    <p class="card-description">
                        Completa tus datos y escríbenos. Te responderemos lo antes posible.
                    </p>
                </div>

                {{-- Mensaje de éxito al enviar el formulario --}}
                @if(session('success'))
                    <div class="contacto-success">
                        <div class="contacto-success-icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div>
                            <strong>¡Éxito!</strong><br>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <form id="contactForm" class="contact-form" method="POST" action="{{ route('contacto.enviar') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">
                            <i class="bi bi-person-fill"></i>
                            Nombre completo
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            pattern="[A-Za-záéíóúÁÉÍÓÚüÜñÑ ]{2,100}"
                            title="Solo letras y espacios, sin números ni símbolos"
                            autocomplete="name"
                            oninput="validarSoloLetras(this)"
                            placeholder="Escribe tu nombre completo"
                            required
                        >
                        <small class="field-error" id="name-error" style="display:none;">Solo se permiten letras y espacios (mínimo 3).</small>
                        @error('name')
                            <small class="server-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="bi bi-envelope-fill"></i>
                            Correo electrónico
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="ejemplo@correo.com"
                            required
                        >
                        @error('email')
                            <small class="server-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">
                            <i class="bi bi-chat-left-text-fill"></i>
                            Mensaje
                        </label>
                        <textarea
                            id="message"
                            name="message"
                            rows="5"
                            placeholder="Cuéntanos cómo podemos ayudarte..."
                            required
                        >{{ old('message') }}</textarea>
                        <small class="field-error" id="message-error" style="display:none;">El mensaje debe tener al menos 10 caracteres.</small>
                        @error('message')
                            <small class="server-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit" id="btn-submit">
                        <span class="btn-submit-icon"><i class="bi bi-send-fill"></i></span>
                        <span>Enviar mensaje</span>
                    </button>
                </form>
            </div>

            <div class="mapa-card">
                <div class="mapa-header">
                    <h3>
                        <i class="bi bi-geo-alt-fill"></i>
                        Nuestra ubicación
                    </h3>
                    <p>Encuéntranos fácilmente y contáctanos también por teléfono, correo o redes sociales.</p>
                </div>

                <div id="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d941.4026417195253!2d-99.71087813043152!3d19.299294398871993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cd881aec291739%3A0x9f53dc1851021f2!2sZaniti!5e0!3m2!1ses-419!2smx!4v1773733570284!5m2!1ses-419!2smx"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Ubicación de Zaniti en Google Maps"
                    ></iframe>
                </div>

                <div class="info-contacto">
                    <div class="info-item">
                        <span class="info-icon"><i class="bi bi-geo-alt-fill"></i></span>
                        <div>
                            <strong>Dirección</strong>
                            <p>Av. Altamirano Manzana 053, Las Culturas, 51355 San Luis Mextepec, Méx.</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon"><i class="bi bi-telephone-fill"></i></span>
                        <div>
                            <strong>Teléfono</strong>
                            <a href="tel:+527228966796">+52 722 896 6796</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon"><i class="bi bi-envelope-fill"></i></span>
                        <div>
                            <strong>Correo</strong>
                            <a href="mailto:grupozaniti@gmail.com">grupozaniti@gmail.com</a>
                        </div>
                    </div>
                </div>

                <div class="redes-wrap">
                    <div class="redes-header">
                        <strong>Síguenos</strong>
                        <span>También estamos disponibles en nuestras redes.</span>
                    </div>

                    <div class="redes-sociales">
                        <a href="https://www.facebook.com/grupozaniti" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://wa.me/527228966796" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// --- VALIDACIONES DE ENTRADA ---

function validarSoloLetras(input) {
    input.value = input.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ ]/g, '');
}

function validarSoloNumeros(input) {
    input.value = input.value.replace(/[^0-9]/g, '').slice(0, 10);
}

document.addEventListener('DOMContentLoaded', function() {

    const form      = document.getElementById('contactForm');
    const btnSubmit = document.getElementById('btn-submit');
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('name-error');

    if (nameInput) {
        nameInput.addEventListener('blur', function() {
            const valid = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ ]{3,100}$/.test(this.value.trim());
            if (nameError) nameError.style.display = valid ? 'none' : 'inline';
        });
    }

    form.addEventListener('submit', function(e) {
        const nameVal = nameInput ? nameInput.value.trim() : '';
        const messageVal = document.getElementById('message').value.trim();

        const nameOk = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ ]{3,100}$/.test(nameVal);
        const messageOk = messageVal.length >= 10;

        if (nameError) nameError.style.display = nameOk ? 'none' : 'inline';

        const msgError = document.getElementById('message-error');
        if (msgError) msgError.style.display = messageOk ? 'none' : 'inline';

        if (!nameOk || !messageOk) {
            e.preventDefault();
            return;
        }

        if (btnSubmit) {
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="btn-submit-icon"><i class="bi bi-hourglass-split"></i></span><span>Enviando...</span>';
            btnSubmit.style.opacity = '0.7';
            btnSubmit.style.cursor = 'not-allowed';
        }
    });
});
</script>
@endsection