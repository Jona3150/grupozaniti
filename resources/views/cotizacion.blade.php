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

<div class="form-group">
<label>Medidas del área a tratar (m²)</label>

<input type="number"
name="area"
value="{{ old('area') }}"
placeholder="Ej. 100"
required>

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


<div class="form-group">

<label>Subir imagen (opcional)</label>

<input type="file"
name="image"
accept="image/*">

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

@endsection
