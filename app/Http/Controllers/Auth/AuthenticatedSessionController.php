<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Muestra la vista de inicio de sesión.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Maneja la autenticación del usuario al iniciar sesión.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Valida las credenciales y autentica al usuario
        $request->authenticate();

        // Regenera la sesión para mayor seguridad
        $request->session()->regenerate();

        // 🔹 Redirigir al inicio del sistema (home) después de iniciar sesión
        return redirect()->intended(route('dashboard'));

    }

    /**
     * Cierra la sesión autenticada del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Cierra la sesión actual del usuario
        Auth::guard('web')->logout();

        // Invalida y regenera el token de la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 🔹 Redirige al inicio público del sistema
        return redirect('/');
    }
}
