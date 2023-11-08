<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('/login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('employee_code');

        $user = User::where('employee_code',$credentials)->first();

        if($user!=null){
            Auth::login($user);
            return redirect()->route('home');
        }else{
            return back()->withErrors(['nomatch' => 'Aucun utilisateur correspondant']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        $request->session()->invalidate(); // Invalidation de la session

        return redirect('/'); // Rediriger vers la page de connexion ou une autre page de votre choix
    }

}
