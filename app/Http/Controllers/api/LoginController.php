<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $employeeCode = $request->input('employee_code');

        $user = User::where('employee_code',$employeeCode)->first();

        if ($user != null) {
            Auth::login($user);
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Identifiants incorrects'], 401); // Renvoyer une erreur non autorisée en cas d'identifiants incorrects
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        $request->session()->invalidate(); // Invalidation de la session

        return redirect('/'); // Rediriger vers la page de connexion ou une autre page de votre choix
    }

}
