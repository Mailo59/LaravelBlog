<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Maneja la solicitud de inicio de sesión.
     */
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8', // Ejemplo: mínimo 8 caracteres para contraseñas
        ], [
            'email.required' => 'El campo de correo es obligatorio.',
            'email.email' => 'El formato del correo no es válido.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);
        

        // Intentar autenticar al usuario
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            // Redirigir al usuario a su dashboard o página principal
            return redirect()->intended(route('principal'));
        }

        // Si las credenciales son incorrectas
        return back()->withErrors([
            'email' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/login')->with('status', 'Has cerrado sesión correctamente.');
    }
    
}
