<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdmin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('AuthAdmin.loginAdmin');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // L'utilisateur est authentifié
            return redirect()->intended('/admin/dashboard'); // Redirigez l'utilisateur vers la page de tableau de bord ou une autre page sécurisée
        }

        // L'authentification a échoué
        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        $request->session()->invalidate(); // Invalidation de la session

        return redirect('/'); // Rediriger vers la page de connexion ou une autre page de votre choix
    }
}
