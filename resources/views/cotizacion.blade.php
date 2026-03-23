@extends('layouts.app')

@section('title', 'Solicitar Cotización | Zaniti')

@section('content')

<section class="cotizacion-content">

<h2>Solicita tu cotización</h2>

<p class="cotizacion-text">
Completa el siguiente formulario para que uno de nuestros asesores pueda contactarte
y brindarte una cotización personalizada para el servicio que necesitas.
</p>

@if(session('success'))
<div class="alert-success">
    <strong>Solicitud enviada.</strong>
    <p>En breve uno de nuestros asesores se pondrá en contacto contigo para brindarte tu cotización.</p>
</div>
@endif


<div class="cotizacion-form-card">

<form method="POST" action="{{ route('cotizacion.enviar') }}" enctype="multipart/form-data">

@csrf

<div class="form-grid">

<!-- FILA 1 -->
<div class="form-group">
<label>Nombre completo</label>
<input type="text" name="name" value="{{ old('name') }}" required>
</div>

<div class="form-group">
<label>Medio de contacto preferido</label>

<select name="contact_method" required>
<option value="">Selecciona una opción</option>

<option value="telefono"
{{ old('contact_method')=='telefono'?'selected':'' }}>
Teléfono
</option>

<option value="whatsapp"
{{ old('contact_method')=='whatsapp'?'selected':'' }}>
WhatsApp
</option>

<option value="correo"
{{ old('contact_method')=='correo'?'selected':'' }}>
Correo electrónico
</option>

</select>
</div>


<!-- FILA 2 -->
<div class="form-group">
<label>Correo electrónico</label>
<input type="email" name="email" value="{{ old('email') }}" required>
</div>

<div class="form-group">
<label>Horario disponible</label>

<select name="contact_time" required>

<option value="">Selecciona un horario</option>

<option value="mañana"
{{ old('contact_time')=='mañana'?'selected':'' }}>
Mañana (9:00 – 12:00)
</option>

<option value="tarde"
{{ old('contact_time')=='tarde'?'selected':'' }}>
Tarde (12:00 – 18:00)
</option>

<option value="noche"
{{ old('contact_time')=='noche'?'selected':'' }}>
Noche (18:00 – 21:00)
</option>

</select>
</div>


<!-- FILA 3 -->
<div class="form-group">
<label>Número de teléfono</label>
<input type="tel" name="phone" value="{{ old('phone') }}" required>
</div>

<div class="form-group" id="contenedor-area">
    <label>Medidas del área a tratar (m²)</label>
    <input type="number" name="area" id="area-input" value="{{ old('area') }}" placeholder="Ej. 50">
</div>


<!-- FILA 4 -->
<div class="form-group">
<label>Tipo de servicio requerido</label>

<select id="service" name="service" required>

<option value="">Selecciona un servicio</option>

<option value="plagas"
{{ old('service')=='plagas'?'selected':'' }}>
Control y prevención de plagas
</option>

<option value="desinfeccion"
{{ old('service')=='desinfeccion'?'selected':'' }}>
Desinfección de espacios
</option>

<option value="limpieza"
{{ old('service')=='limpieza'?'selected':'' }}>
Limpieza en general
</option>

<option value="mantenimiento"
{{ old('service')=='mantenimiento'?'selected':'' }}>
Mantenimiento en general
</option>

<option value="venta"
{{ old('service')=='venta'?'selected':'' }}>
Venta de equipos y refacciones
</option>

<option value="reparacion"
{{ old('service')=='reparacion'?'selected':'' }}>
Reparación de equipos
</option>

</select>
</div>


<div class="form-group full-width">
    <label>Imagen de referencia (opcional)</label>
    <div id="drop-zone" class="upload-container">
        <div class="upload-content">
            <i class="fas fa-cloud-upload-alt"></i>
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

</div>


<!-- CAMPO COMPLETO -->
<div class="form-group full-width">

<label>Detalles adicionales</label>

<textarea
name="message"
rows="5"
placeholder="Cuéntanos más sobre tus necesidades.">{{ old('message') }}</textarea>

</div>


<button type="submit" class="btn-submit">
Enviar solicitud de cotización
</button>


<p class="cotizacion-note">
Un asesor de Zaniti se pondrá en contacto contigo lo antes posible
para brindarte la información que necesitas.
</p>

</form>

</div>

</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // === 1. LÓGICA DE MOSTRAR/OCULTAR METROS CUADRADOS ===
    const serviceSelect = document.getElementById('service');
    const contenedorArea = document.getElementById('contenedor-area');
    const inputArea = document.getElementById('area-input');

    function toggleAreaField() {
        const valor = serviceSelect.value;
        // Ocultar si es venta, reparación o mantenimiento
        if (valor === 'venta' || valor === 'reparacion' || valor === 'mantenimiento') {
            if (contenedorArea) contenedorArea.style.display = 'none';
            if (inputArea) {
                inputArea.value = 0; // Evita fallos en la validación numérica
                inputArea.required = false;
            }
        } else {
            if (contenedorArea) contenedorArea.style.display = 'block';
            if (inputArea) inputArea.required = true;
        }
    }

    // Escuchar cambios en el selector de servicios
    if (serviceSelect) {
        serviceSelect.addEventListener('change', toggleAreaField);
        toggleAreaField(); // Ejecución inicial al cargar
    }


    // === 2. LÓGICA DE ARRASTRAR Y SOLTAR (DRAG & DROP) PARA IMAGEN ===
    const dropZone = document.getElementById('drop-zone');
    const imageInput = document.getElementById('image-input');
    const preview = document.getElementById('image-preview');
    const imgRender = document.getElementById('img-render');
    const removeBtn = document.getElementById('remove-img');

    if (dropZone && imageInput) {
        // Al hacer clic en la zona, abrir el buscador de archivos
        dropZone.addEventListener('click', () => imageInput.click());

        // Prevenir comportamiento por defecto de los eventos de arrastre
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        // Efectos visuales al arrastrar
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'));
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'));
        });

        // Manejar la soltada del archivo
        dropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length) {
                imageInput.files = files; // Asignar el archivo arrastrado al input real
                handlePreview(files[0]);
            }
        });

        // Manejar selección normal por clic
        imageInput.addEventListener('change', () => {
            if (imageInput.files.length) {
                handlePreview(imageInput.files[0]);
            }
        });
    }

    // Función para procesar y mostrar la vista previa
    function handlePreview(file) {
        // Validar que sea imagen
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

    // Botón para quitar la imagen y volver a mostrar la zona de carga
    if (removeBtn) {
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Evitar que se dispare el clic de la dropZone
            imageInput.value = ""; // Limpiar el input
            if (preview && dropZone) {
                preview.style.display = 'none';
                dropZone.style.display = 'block';
            }
        });
    }
});
</script>
@endsection
