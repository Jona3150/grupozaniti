@extends('layouts.app')

@section('title', 'Solicitar Cotización | Zaniti')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<section class="cotizacion-content">
    <style>
        .cotizacion-content {
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
            --zaniti-success-bg: #ECFDF5;
            --zaniti-success-border: #A7F3D0;
            --zaniti-success-text: #065F46;
            --zaniti-error: #DC2626;
            --zaniti-radius-xl: 28px;
            --zaniti-radius-lg: 22px;
            --zaniti-radius-md: 16px;
            --zaniti-radius-sm: 12px;

            position: relative;
            overflow: hidden;
            padding: clamp(1.5rem, 4vw, 3.5rem) 1rem;
            background: var(--zaniti-bg);
            color: var(--zaniti-ink);
        }

        .cotizacion-content * {
            box-sizing: border-box;
        }

        .cotizacion-content::before,
        .cotizacion-content::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
            z-index: 0;
        }

        .cotizacion-content::before {
            width: 340px;
            height: 340px;
            top: -110px;
            left: -80px;
            background: radial-gradient(circle, rgba(136, 230, 237, 0.34) 0%, rgba(136, 230, 237, 0) 72%);
        }

        .cotizacion-content::after {
            width: 420px;
            height: 420px;
            right: -100px;
            bottom: -140px;
            background: radial-gradient(circle, rgba(110, 223, 231, 0.26) 0%, rgba(110, 223, 231, 0) 72%);
        }

        .cotizacion-     {
            position: relative;
            z-index: 1;
            max-width: 1280px;
            margin: 0 auto;
        }

        .cotizacion-head {
            max-width: 760px;
            margin: 0 auto 1.75rem;
            text-align: center;
        }

        .cotizacion-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.65rem 1rem;
            margin-bottom: 1rem;
            border-radius: 999px;
            background: rgba(136, 230, 237, 0.18);
            color: var(--zaniti-ink);
            font-size: 0.86rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .cotizacion-badge i {
            font-size: 0.95rem;
            color: var(--zaniti-ink);
        }

        .cotizacion-head h2 {
            margin: 0 0 0.7rem;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.05;
            letter-spacing: -0.03em;
            color: var(--zaniti-ink);
        }

        .cotizacion-text {
            margin: 0 auto;
            max-width: 62ch;
            color: var(--zaniti-muted);
            line-height: 1.8;
            font-size: 1rem;
        }

        .alert-success {
            display: flex;
            gap: 0.9rem;
            align-items: flex-start;
            max-width: 980px;
            margin: 0 auto 1.5rem;
            padding: 1rem 1.1rem;
            border-radius: var(--zaniti-radius-md);
            border: 1px solid var(--zaniti-success-border);
            background: var(--zaniti-success-bg);
            color: var(--zaniti-success-text);
            box-shadow: var(--zaniti-shadow-soft);
        }

        .alert-success i {
            flex: 0 0 42px;
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(136, 230, 237, 0.25);
            color: var(--zaniti-ink);
            font-size: 1.15rem;
        }

        .alert-success strong {
            display: block;
            margin-bottom: 0.2rem;
        }

        .alert-success p {
            margin: 0;
            line-height: 1.65;
        }

        .cotizacion-form-card {
            max-width: 980px;
            margin: 0 auto;
            padding: clamp(1.25rem, 3vw, 2rem);
            border-radius: var(--zaniti-radius-xl);
            border: 1px solid var(--zaniti-border);
            background: var(--zaniti-surface);
            box-shadow: var(--zaniti-shadow);
            backdrop-filter: blur(10px);
        }

        .form-topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(17, 17, 17, 0.06);
        }

        .form-topbar h3 {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin: 0 0 0.35rem;
            font-size: clamp(1.35rem, 2vw, 1.8rem);
            color: var(--zaniti-ink);
        }

        .form-topbar h3 i {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(136, 230, 237, 0.22);
            color: var(--zaniti-ink);
            font-size: 1.05rem;
        }

        .form-topbar p {
            margin: 0;
            color: var(--zaniti-muted);
            line-height: 1.7;
            font-size: 0.96rem;
        }

        .cotizacion-chip {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1rem;
            border-radius: 16px;
            background: var(--zaniti-surface-solid);
            border: 1px solid rgba(17, 17, 17, 0.06);
            color: var(--zaniti-ink-soft);
            font-size: 0.92rem;
            font-weight: 700;
            box-shadow: var(--zaniti-shadow-soft);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.1rem 1rem;
        }

        .form-group {
            display: grid;
            gap: 0.5rem;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--zaniti-ink);
        }

        .form-group label i {
            width: 18px;
            text-align: center;
            color: var(--zaniti-ink-soft);
            font-size: 0.98rem;
        }

        .field-control {
            position: relative;
        }

        .field-control input,
        .field-control select,
        .field-control textarea,
        .form-group > input,
        .form-group > select,
        .form-group > textarea {
            width: 100%;
            border: 1px solid rgba(17, 17, 17, 0.10);
            background: #ffffff;
            color: var(--zaniti-ink);
            border-radius: 16px;
            padding: 0.98rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            outline: none;
            transition: border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease, background 0.22s ease;
        }

        .field-control select,
        .form-group > select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, #2B2B35 50%), linear-gradient(135deg, #2B2B35 50%, transparent 50%);
            background-position: calc(100% - 20px) calc(50% - 3px), calc(100% - 14px) calc(50% - 3px);
            background-size: 6px 6px, 6px 6px;
            background-repeat: no-repeat;
            padding-right: 3rem;
        }

        .field-control textarea,
        .form-group > textarea {
            min-height: 150px;
            resize: vertical;
        }

        .field-control input::placeholder,
        .field-control textarea::placeholder,
        .form-group > input::placeholder,
        .form-group > textarea::placeholder {
            color: #8B93A1;
        }

        .field-control input:focus,
        .field-control select:focus,
        .field-control textarea:focus,
        .form-group > input:focus,
        .form-group > select:focus,
        .form-group > textarea:focus {
            border-color: rgba(110, 223, 231, 0.95);
            box-shadow: 0 0 0 4px rgba(136, 230, 237, 0.28);
            background: #ffffff;
        }

        .field-help {
            margin: 0;
            color: var(--zaniti-muted);
            line-height: 1.55;
            font-size: 0.84rem;
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

        .upload-container {
            position: relative;
            border: 1.5px dashed rgba(110, 223, 231, 0.95);
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(221, 249, 251, 0.72) 0%, rgba(255, 255, 255, 0.96) 100%);
            min-height: 220px;
            display: grid;
            place-items: center;
            padding: 1.5rem;
            cursor: pointer;
            transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, background 0.22s ease;
        }

        .upload-container:hover,
        .upload-container.dragover {
            transform: translateY(-2px);
            box-shadow: 0 14px 34px rgba(110, 223, 231, 0.18);
            background: linear-gradient(180deg, rgba(221, 249, 251, 0.95) 0%, rgba(255, 255, 255, 1) 100%);
        }

        .upload-content {
            text-align: center;
            color: var(--zaniti-ink-soft);
        }

        .upload-content i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            margin-bottom: 0.9rem;
            border-radius: 24px;
            background: rgba(136, 230, 237, 0.32);
            color: var(--zaniti-ink);
            font-size: 1.75rem;
            box-shadow: var(--zaniti-shadow-soft);
        }

        .upload-content p {
            margin: 0 0 0.35rem;
            font-size: 1rem;
            font-weight: 700;
            color: var(--zaniti-ink);
        }

        .upload-content p span {
            color: #000000;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .upload-content small {
            color: var(--zaniti-muted);
            font-size: 0.88rem;
        }

        .preview-box {
            position: relative;
            margin-top: 1rem;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid rgba(17, 17, 17, 0.08);
            box-shadow: var(--zaniti-shadow-soft);
            background: #ffffff;
        }

        .preview-box img {
            display: block;
            width: 100%;
            max-height: 340px;
            object-fit: cover;
        }

        #remove-img {
            position: absolute;
            top: 0.8rem;
            right: 0.8rem;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 999px;
            background: rgba(17, 17, 17, 0.82);
            color: #ffffff;
            font-size: 1.4rem;
            line-height: 1;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(17, 17, 17, 0.18);
            transition: transform 0.22s ease, background 0.22s ease;
        }

        #remove-img:hover {
            transform: scale(1.05);
            background: #000000;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            min-height: 56px;
            margin-top: 1.2rem;
            padding: 1rem 1.25rem;
            border: none;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--zaniti-primary) 0%, var(--zaniti-primary-strong) 100%);
            color: var(--zaniti-ink);
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 0.01em;
            box-shadow: 0 16px 35px rgba(110, 223, 231, 0.30);
            cursor: pointer;
            transition: transform 0.22s ease, box-shadow 0.22s ease, opacity 0.22s ease, filter 0.22s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(110, 223, 231, 0.38);
            filter: brightness(0.98);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            box-shadow: none;
        }

        .cotizacion-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            margin: 1rem 0 0;
            color: var(--zaniti-muted);
            text-align: center;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        .cotizacion-note i {
            color: var(--zaniti-ink-soft);
        }

        @media (max-width: 900px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-topbar {
                flex-direction: column;
                align-items: stretch;
            }

            .cotizacion-chip {
                align-self: flex-start;
            }
        }

        @media (max-width: 768px) {
            .cotizacion-content {
                padding: 1rem 0.85rem 2rem;
            }

            .cotizacion-form-card {
                padding: 1rem;
                border-radius: 22px;
            }

            .upload-container {
                min-height: 190px;
                padding: 1.15rem;
            }

            .upload-content i {
                width: 62px;
                height: 62px;
                font-size: 1.5rem;
                border-radius: 20px;
            }

            .btn-submit {
                min-height: 54px;
            }
        }
    </style>

    <div class="cotizacion-shell">
        <div class="cotizacion-head">
            <span class="cotizacion-badge">
                <i class="bi bi-stars"></i>
                Solicitud
            </span>

            <h2>Solicita tu cotización</h2>

            <p class="cotizacion-text">
                Completa el siguiente formulario para que uno de nuestros asesores pueda contactarte
                y brindarte una cotización personalizada para el servicio que necesitas.
            </p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="bi bi-check2-circle"></i>
                <div>
                    <strong>Solicitud enviada.</strong>
                    <p>En breve uno de nuestros asesores se pondrá en contacto contigo para brindarte tu cotización.</p>
                </div>
            </div>
        @endif

        <div class="cotizacion-form-card">
            <div class="form-topbar">
                <div>
                    <h3>
                        <i class="bi bi-clipboard2-data"></i>
                        <span>Formulario de cotización</span>
                    </h3>
                    <p>Déjanos tus datos y algunos detalles del servicio para atenderte mejor.</p>
                </div>

                <div class="cotizacion-chip">
                    <i class="bi bi-shield-check"></i>
                    Datos protegidos y atención personalizada
                </div>
            </div>

            <form method="POST" action="{{ route('cotizacion.enviar') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name"><i class="bi bi-person"></i> Nombre completo</label>
                        <div class="field-control">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                required
                                pattern="[A-Za-záéíóúÁÉÍÓÚüÜñÑ ]{2,100}"
                                title="Solo letras y espacios, sin números ni símbolos"
                                autocomplete="name"
                                placeholder="Escribe tu nombre completo"
                            >
                        </div>
                        <small class="field-error" id="name-error" style="display:none;">Solo se permiten letras y espacios.</small>
                    </div>

                    <div class="form-group">
                        <label for="contact_method"><i class="bi bi-chat-dots"></i> Medio de contacto preferido</label>
                        <div class="field-control">
                            <select name="contact_method" id="contact_method" required>
                                <option value="">Selecciona una opción</option>
                                <option value="telefono" {{ old('contact_method')=='telefono'?'selected':'' }}>Teléfono</option>
                                <option value="whatsapp" {{ old('contact_method')=='whatsapp'?'selected':'' }}>WhatsApp</option>
                                <option value="correo" {{ old('contact_method')=='correo'?'selected':'' }}>Correo electrónico</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="bi bi-envelope"></i> Correo electrónico</label>
                        <div class="field-control">
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contact_time"><i class="bi bi-clock-history"></i> Horario disponible</label>
                        <div class="field-control">
                            <select name="contact_time" id="contact_time" required>
                                <option value="">Selecciona un horario</option>
                                <option value="mañana" {{ old('contact_time')=='mañana'?'selected':'' }}>Mañana (9:00 – 12:00)</option>
                                <option value="tarde" {{ old('contact_time')=='tarde'?'selected':'' }}>Tarde (12:00 – 18:00)</option>
                                <option value="noche" {{ old('contact_time')=='noche'?'selected':'' }}>Noche (18:00 – 21:00)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone"><i class="bi bi-telephone"></i> Número de teléfono</label>
                        <div class="field-control">
                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                value="{{ old('phone') }}"
                                required
                                pattern="[0-9]{10}"
                                maxlength="10"
                                title="Exactamente 10 dígitos numéricos"
                                placeholder="Ej. 5512345678"
                                inputmode="numeric"
                                autocomplete="tel"
                            >
                        </div>
                        <small class="field-error" id="phone-error" style="display:none;">Ingresa exactamente 10 dígitos numéricos.</small>
                    </div>

                    <div class="form-group" id="contenedor-area">
                        <label for="area-input"><i class="bi bi-bounding-box"></i> Medidas del área a tratar (m²)</label>
                        <div class="field-control">
                            <input type="number" name="area" id="area-input" value="{{ old('area') }}" placeholder="Ej. 50" min="1">
                        </div>
                        <small class="field-help">Solo aplica para servicios donde se requiere evaluar superficie.</small>
                        <small class="field-error" id="area-error" style="display:none;">El área debe ser mayor a 0.</small>
                    </div>

                    <div class="form-group">
                        <label for="service"><i class="bi bi-briefcase"></i> Tipo de servicio requerido</label>
                        <div class="field-control">
                            <select id="service" name="service" required>
                                <option value="">Selecciona un servicio</option>
                                <option value="plagas" {{ old('service')=='plagas'?'selected':'' }}>Control y prevención de plagas</option>
                                <option value="desinfeccion" {{ old('service')=='desinfeccion'?'selected':'' }}>Desinfección de espacios</option>
                                <option value="limpieza" {{ old('service')=='limpieza'?'selected':'' }}>Limpieza en general</option>
                                <option value="mantenimiento" {{ old('service')=='mantenimiento'?'selected':'' }}>Mantenimiento en general</option>
                                <option value="venta" {{ old('service')=='venta'?'selected':'' }}>Venta de equipos y refacciones</option>
                                <option value="reparacion" {{ old('service')=='reparacion'?'selected':'' }}>Reparación de equipos</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="image-input"><i class="bi bi-image"></i> Imagen de referencia (opcional)</label>

                        <div id="drop-zone" class="upload-container">
                            <div class="upload-content">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p>Arrastra tu imagen aquí o <span>haz clic para buscar</span></p>
                                <small>JPG, PNG (Máx. 2MB)</small>
                            </div>
                            <input type="file" name="image" id="image-input" accept="image/*" style="display: none;">
                        </div>

                        <div id="image-preview" class="preview-box" style="display: none;">
                            <img src="" alt="Vista previa" id="img-render">
                            <button type="button" id="remove-img">&times;</button>
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="message"><i class="bi bi-card-text"></i> Detalles adicionales</label>
                        <div class="field-control">
                            <textarea
                                name="message"
                                id="message"
                                rows="5"
                                placeholder="Cuéntanos más sobre tus necesidades."
                            >{{ old('message') }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="btn-submit">
                    <i class="bi bi-send-check"></i>
                    Enviar solicitud de cotización
                </button>
<div class="legal-consent-container" style="margin-top: 25px; margin-bottom: 25px; padding: 15px; background: var(--zaniti-surface-2); border-radius: 12px; border: 1px solid var(--zaniti-border);">
    <label class="checkbox-wrapper" style="display: flex; align-items: flex-start; gap: 12px; cursor: pointer;">
        <input type="checkbox" id="privacy_policy_cot" name="privacy_policy" style="width: 22px; height: 22px; accent-color: var(--zaniti-primary); margin-top: 2px;" required>
        <span class="checkbox-text" style="font-size: 0.95rem; color: var(--zaniti-ink-soft); line-height: 1.5;">
            Acepto que mis datos y las imágenes adjuntas sean tratados conforme al <a href="{{ url('/aviso-privacidad') }}" target="_blank" style="color: var(--zaniti-primary-strong); font-weight: 700; text-decoration: underline;">Aviso de Privacidad</a> de Zaniti para la elaboración de mi presupuesto.
        </span>
    </label>
    <div id="privacy-error" style="color: #dc2626; font-size: 0.85rem; display: none; margin-top: 10px; font-weight: 600;">
        <i class="bi bi-exclamation-triangle-fill"></i> Es necesario aceptar el aviso de privacidad para procesar tu cotización.
    </div>
</div>
                <p class="cotizacion-note">
                    <i class="bi bi-info-circle"></i>
                    Un asesor de Zaniti se pondrá en contacto contigo lo antes posible para brindarte la información que necesitas.
                </p>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // === 0. VALIDACIÓN DE CAMPOS Y BOTÓN ANTI-DOBLE ENVÍO ===
    const form       = document.querySelector('form');
    const btnSubmit  = document.getElementById('btn-submit');
    const nameInput  = document.getElementById('name');
    const phoneInput = document.getElementById('phone');
    const nameError  = document.getElementById('name-error');
    const phoneError = document.getElementById('phone-error');

    // Nombre: solo letras (incluyendo acentos y ñ) y espacios
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^A-Za-záéíóúÁÉÍÓÚüÜñÑ ]/g, '');
        });
        nameInput.addEventListener('blur', function() {
            const valid = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ ]{2,100}$/.test(this.value.trim());
            nameError.style.display = valid ? 'none' : 'inline';
        });
    }

    // Teléfono: solo dígitos, máximo 10
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
        });
        phoneInput.addEventListener('blur', function() {
            const valid = /^[0-9]{10}$/.test(this.value);
            phoneError.style.display = valid ? 'none' : 'inline';
        });
    }

    // Botón anti-doble envío
    if (form && btnSubmit) {
        form.addEventListener('submit', function(e) {
    const nameVal  = nameInput ? nameInput.value.trim() : '';
    const phoneVal = phoneInput ? phoneInput.value : '';
    
    // Validaciones de formato
    const nameOk   = /^[A-Za-záéíóúÁÉÍÓÚüÜñÑ ]{2,100}$/.test(nameVal);
    const phoneOk  = /^[0-9]{10}$/.test(phoneVal);

    // Validación de Área (m2)
    const areaInput = document.getElementById('area-input');
    const areaError = document.getElementById('area-error');
    let areaOk = true;

    if (areaInput && areaInput.required) {
        const areaVal = parseFloat(areaInput.value);
        areaOk = !isNaN(areaVal) && areaVal > 0;
        if (areaError) areaError.style.display = areaOk ? 'none' : 'inline';
    }

    // --- NUEVA VALIDACIÓN: Checkbox de Privacidad ---
    const privacyCheck = document.getElementById('privacy_policy_cot');
    const privacyError = document.getElementById('privacy-error');
    const privacyOk = privacyCheck ? privacyCheck.checked : true; // true si no existe el elemento

    if (privacyError) {
        privacyError.style.display = privacyOk ? 'none' : 'block';
    }
    // ------------------------------------------------

    // Mostrar errores de texto
    if (!nameOk && nameError)   nameError.style.display  = 'inline';
    if (!phoneOk && phoneError) phoneError.style.display = 'inline';

    // Validación final: Si algo falla, detenemos el envío
    if (!nameOk || !phoneOk || !areaOk || !privacyOk) {
        e.preventDefault();
        
        // Si el error fue por privacidad, hacemos un scroll suave hacia el aviso
        if (!privacyOk && privacyCheck) {
            privacyCheck.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        return;
    }

    // Efecto visual de "Enviando"
    btnSubmit.disabled = true;
    btnSubmit.innerHTML = '<i class="bi bi-hourglass-split"></i> Enviando...';
    btnSubmit.style.opacity = '0.7';
    btnSubmit.style.cursor  = 'not-allowed';
});
    }

    // === 1. LÓGICA DE MOSTRAR/OCULTAR METROS CUADRADOS ===
    const serviceSelect = document.getElementById('service');
    const contenedorArea = document.getElementById('contenedor-area');
    const inputArea = document.getElementById('area-input');

    function toggleAreaField() {
        const valor = serviceSelect.value;
        if (valor === 'venta' || valor === 'reparacion' || valor === 'mantenimiento') {
            if (contenedorArea) contenedorArea.style.display = 'none';
            if (inputArea) {
                inputArea.value = 0;
                inputArea.required = false;
            }
        } else {
            if (contenedorArea) contenedorArea.style.display = 'grid';
            if (inputArea) inputArea.required = true;
        }
    }

    if (serviceSelect) {
        serviceSelect.addEventListener('change', toggleAreaField);
        toggleAreaField();
    }

    // === 2. LÓGICA DE ARRASTRAR Y SOLTAR PARA IMAGEN ===
    const dropZone = document.getElementById('drop-zone');
    const imageInput = document.getElementById('image-input');
    const preview = document.getElementById('image-preview');
    const imgRender = document.getElementById('img-render');
    const removeBtn = document.getElementById('remove-img');

    if (dropZone && imageInput) {
        dropZone.addEventListener('click', () => imageInput.click());

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'));
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'));
        });

        dropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length) {
                imageInput.files = files;
                handlePreview(files[0]);
            }
        });

        imageInput.addEventListener('change', () => {
            if (imageInput.files.length) {
                handlePreview(imageInput.files[0]);
            }
        });
    }

    function handlePreview(file) {
        if (!file.type.startsWith('image/')) {
            alert('Por favor, sube solo archivos de imagen.');
            return;
        }

        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (e) => {
            if (imgRender && preview && dropZone) {
                imgRender.src = e.target.result;
                preview.style.display = 'block';
                dropZone.style.display = 'none';
            }
        };
    }

    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            imageInput.value = "";
            if (preview && dropZone) {
                preview.style.display = 'none';
                dropZone.style.display = 'block';
            }
        });
    }
});
</script>
@endsection