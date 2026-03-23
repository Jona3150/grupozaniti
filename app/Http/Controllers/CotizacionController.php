<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CotizacionMail;

class CotizacionController extends Controller
{
    public function submit(Request $request)
    {
        // Validación Corregida
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'service' => 'required',
            // El área es requerida SOLO SI el servicio NO ES venta, reparacion o mantenimiento
            'area' => $request->service === 'venta' || $request->service === 'reparacion' || $request->service === 'mantenimiento'
            ? 'nullable|numeric'
            : 'required|numeric',
            'contact_method' => 'required',
            'contact_time' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Si no aplica área, le damos un valor por defecto para el correo
        if (!isset($data['area']) || in_array($data['service'], ['venta', 'reparacion', 'mantenimiento'])) {
            $data['area'] = 'No aplica';
        }

        Mail::to('dejesuscynthia94@gmail.com')->send(new CotizacionMail($data));

        return back()->with('success', 'En breve uno de nuestros asesores se pondrá en contacto contigo.');
    }
}