@extends('layouts.app')

@section('title', 'Solicitar Cotización | Zaniti - Control de Plagas y Desinfección')

@section('content')
<section class="cotizacion-content">
  <h2>Solicita tu cotización</h2>
  <p>Completa el siguiente formulario para que nuestro equipo pueda darte un presupuesto exacto para tu servicio.</p>

  @if(session('success'))
    <div style="background: #d1ecf1; color: #0c5460; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #bee5eb;">
      <strong>Estimación lista:</strong> {{ session('success') }}
    </div>
  @endif

  <div class="cotizacion-form-card">
    <form id="cotizacionForm" enctype="multipart/form-data" method="POST" action="{{ route('cotizacion.enviar') }}">
      @csrf
      
      <div class="form-group">
        <label for="name">Nombre completo</label>
        <input 
          type="text" 
          id="name" 
          name="name" 
          value="{{ old('name') }}" 
          required
        >
        @error('name') <small style="color: #e3342f;">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <small style="color: #e3342f;">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="phone">Número de teléfono</label>
        <input 
          type="tel" 
          id="phone" 
          name="phone" 
          value="{{ old('phone') }}" 
          required
        >
        @error('phone') <small style="color: #e3342f;">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="service">Tipo de servicio requerido</label>
        <select id="service" name="service" required>
          <option value="">Selecciona un servicio</option>
          <option value="plagas" {{ old('service') == 'plagas' ? 'selected' : '' }}>Control y prevención de plagas</option>
          <option value="desinfeccion" {{ old('service') == 'desinfeccion' ? 'selected' : '' }}>Desinfección de espacios</option>
          <option value="limpieza" {{ old('service') == 'limpieza' ? 'selected' : '' }}>Limpieza en general</option>
          <option value="mantenimiento" {{ old('service') == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento en general</option>
          <option value="venta" {{ old('service') == 'venta' ? 'selected' : '' }}>Venta de equipos y refacciones</option>
          <option value="reparacion" {{ old('service') == 'reparacion' ? 'selected' : '' }}>Reparación de equipos</option>
        </select>
      </div>

      <div class="form-group" id="plaga-group" style="display: {{ old('service') == 'plagas' ? 'block' : 'none' }};">
        <label for="plaga">¿Qué plaga deseas controlar?</label>
        <input type="text" id="plaga" name="plaga" value="{{ old('plaga') }}" placeholder="Ej. cucarachas, hormigas, ratas, etc.">
      </div>

      <div class="form-group">
        <label for="area">Medidas del área a tratar (m²)</label>
        <input type="number" id="area" name="area" value="{{ old('area') }}" required placeholder="Ej. 100">
        @error('area') <small style="color: #e3342f;">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="image-upload">Subir imagen de la plaga (opcional)</label>
        <div class="image-upload-container">
          <input type="file" id="image-upload" name="image" accept="image/*">
          <label for="image-upload" class="upload-label">
            <span>Haz clic para seleccionar una imagen</span>
          </label>
          <div id="image-preview" class="image-preview" style="display: none;">
            <img id="preview-image" src="#" alt="Vista previa de la imagen">
          </div>
        </div>
        @error('image') <small style="color: #e3342f;">{{ $message }}</small> @enderror
      </div>

      <div class="form-group">
        <label for="message">Detalles adicionales</label>
        <textarea id="message" name="message" rows="5" placeholder="Cuéntanos más sobre tus necesidades.">{{ old('message') }}</textarea>
      </div>

      <button type="submit" class="btn-submit">Solicitar cotización</button>

    </form>
  </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("cotizacionForm");
    const nombre = document.getElementById("name");
    const telefono = document.getElementById("phone");
    const boton = form.querySelector("button[type='submit']");
    const servicio = document.getElementById("service");
    const plagaGroup = document.getElementById("plaga-group");

    // Validación nombre (solo letras)
    nombre.addEventListener("input", function() {
        this.value = this.value.replace(/[^a-zA-ZÁÉÍÓÚáéíóúñÑ\s]/g, '');
    });

    // Validación teléfono (solo números)
    telefono.addEventListener("input", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // Mostrar campo plaga dinámicamente
    servicio.addEventListener("change", function() {
        if (this.value === "plagas") {
            plagaGroup.style.display = "block";
        } else {
            plagaGroup.style.display = "none";
        }
    });

    // Evitar múltiples envíos
    form.addEventListener("submit", function() {
        boton.disabled = true;
        boton.innerText = "Enviando...";
    });

});
</script>
@endsection
