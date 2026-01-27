<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function submit(Request $request)
    {
        // Validación rigurosa
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string',
            'service' => 'required',
            'area'    => 'required|numeric',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Máximo 2MB
        ]);

        // Lógica de negocio: Cálculo de presupuesto base
        $precioBase = 500;
        $precioMetro = ($request->service == 'plagas') ? 20 : 15;
        $totalEstimado = $precioBase + ($request->area * $precioMetro);

        // En un futuro, aquí se guardará la imagen en storage/app/public/cotizaciones

        return back()->with('success', "¡Solicitud recibida! El presupuesto estimado para tu servicio es de $" . number_format($totalEstimado, 2) . " MXN. Nos comunicaremos contigo al teléfono " . $request->phone . " para confirmar.");
    }
}