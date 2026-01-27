<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function submit(Request $request)
    {
        // Validación de seguridad
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        // Aquí es donde se configurará el envío de email real
        // Por ahora, simulamos que se guardó o envió con éxito
        
        return back()->with('success', '¡Gracias! Tu mensaje ha sido enviado con éxito.');
    }
}