<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CotizacionMail;

class CotizacionController extends Controller
{
    public function submit(Request $request)
    {
        // Validación
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'service' => 'required',
            'area'    => 'required|numeric',
            'contact_method' => 'required',
            'contact_time' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Guardamos los datos
        $data = $request->all();

        // Enviar correo a la empresa
        Mail::to('dejesuscynthia94@gmail.com')
            ->send(new CotizacionMail($data));

        // Respuesta al usuario
        return back()->with(
            'success',
            'En breve uno de nuestros asesores se pondrá en contacto contigo para brindarte tu cotización.'
        );
    }
}