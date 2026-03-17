<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Nueva solicitud de cotización</title>
</head>

<body style="background:#f4f6f8;font-family:Arial,sans-serif;padding:30px;">

<table width="100%" cellspacing="0" cellpadding="0">
<tr>
<td align="center">

<table width="600" style="background:#ffffff;border-radius:8px;border:1px solid #e5e5e5;overflow:hidden">

<!-- Header -->
<tr>
<td style="background:#2b7a78;color:white;padding:20px;text-align:center">
<h2 style="margin:0">Nueva solicitud de cotización</h2>
<p style="margin:5px 0 0 0;font-size:14px">Sitio web Zaniti</p>
</td>
</tr>

<!-- Contenido -->
<tr>
<td style="padding:25px">

<h3 style="color:#333;margin-top:0">Datos del cliente</h3>

<table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse">

<tr style="background:#f8f8f8">
<td width="40%"><strong>Nombre</strong></td>
<td>{{ $data['name'] }}</td>
</tr>

<tr>
<td><strong>Correo</strong></td>
<td>{{ $data['email'] }}</td>
</tr>

<tr style="background:#f8f8f8">
<td><strong>Teléfono</strong></td>
<td>{{ $data['phone'] }}</td>
</tr>

<tr>
<td><strong>Medio de contacto</strong></td>
<td>{{ $data['contact_method'] }}</td>
</tr>

<tr style="background:#f8f8f8">
<td><strong>Horario disponible</strong></td>
<td>{{ $data['contact_time'] }}</td>
</tr>

</table>


<h3 style="color:#333;margin-top:30px">Información del servicio</h3>

<table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse">

<tr style="background:#f8f8f8">
<td width="40%"><strong>Servicio solicitado</strong></td>
<td>{{ $data['service'] }}</td>
</tr>

<tr>
<td><strong>Área aproximada</strong></td>
<td>{{ $data['area'] }} m²</td>
</tr>

</table>


@if(!empty($data['message']))
<h3 style="margin-top:30px;color:#333">Detalles adicionales</h3>

<div style="background:#f8f8f8;padding:15px;border-radius:6px">
{{ $data['message'] }}
</div>
@endif

</td>
</tr>

<!-- Footer -->
<tr>
<td style="background:#f4f6f8;padding:15px;text-align:center;font-size:12px;color:#777">
Correo generado automáticamente desde el sitio web de Zaniti
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>