<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de login.
     * Si ya estás logueado, te manda al dashboard.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    /**
     * Procesa el intento de entrada.
     */
    public function login(Request $request)
    {
        // Validamos que escribieron algo
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intentamos entrar
        if (Auth::attempt($credentials)) {
            // Éxito: Generamos sesión y mandamos al dashboard
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        // Error: Regresamos con mensaje
        return back()->withErrors([
            'email' => 'El correo o la contraseña no son correctos.',
        ])->onlyInput('email');
    }

    /**
     * Salir del sistema
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}