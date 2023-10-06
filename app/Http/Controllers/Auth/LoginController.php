<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('employee_code');

        if (Auth::attempt($credentials)) {
            // L'utilisateur est authentifié
            return redirect()->intended('/dashboard'); // Redirigez l'utilisateur vers la page de tableau de bord ou une autre page sécurisée
        }

        // L'authentification a échoué
        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

}
