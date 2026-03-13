<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class ContactoController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        $datos = $request->only(['name', 'email', 'message']);

        Mail::to('dejesuscynthia94@gmail.com')->send(new ContactoMail($datos));

        return back()->with('success', '¡Mensaje enviado correctamente!');
    }
}