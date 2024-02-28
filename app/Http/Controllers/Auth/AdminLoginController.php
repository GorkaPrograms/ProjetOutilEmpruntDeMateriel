<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function view(){
        // Vérifier si l'utilisateur a la clé admin_password_verified dans sa session
        if (session()->has('admin_password_verified')) {
            // Rediriger l'utilisateur vers le tableau de bord administratif ou une autre page appropriée
            return redirect('/admin/dashboard/users');
        }

        return view('AuthAdmin.loginAdmin');
    }
    public function verifyAdminPassword(Request $request)
    {
        $password = $request->input('admin_password');

        // Récupérer l'utilisateur actuel
        $user = Auth::user();

        // Vérifier si l'utilisateur est un administrateur
        if (!$user->is_admin) {
            // Si l'utilisateur n'est pas un administrateur, rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'Vous n\'avez pas les autorisations nécessaires pour accéder au pannel administratif.');
        }

        // Vérifier si le mot de passe administrateur est correct
        if (Hash::check($password, $user->password)) {
            // Ajouter admin_password_verified à la session
            $request->session()->put('admin_password_verified', true);
            // Rediriger vers le tableau de bord administratif ou une autre page appropriée
            return redirect()->intended('/admin/dashboard/users');
        } else {
            // Le mot de passe administrateur est incorrect
            // Rediriger vers une page d'erreur ou afficher un message d'erreur approprié
            return redirect()->back()->with('error', 'Mot de passe administrateur incorrect');
        }
    }
}
