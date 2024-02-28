<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Vérifier si le mot de passe administrateur a été saisi correctement
        if (!$request->session()->has('admin_password_verified')) {
            return redirect('/admin/check-password'); // Rediriger vers la page de vérification du mot de passe administrateur si le mot de passe n'a pas encore été saisi
        }

        // Si l'utilisateur est connecté, un administrateur et le mot de passe administrateur a été saisi correctement, autoriser l'accès à la route
        return $next($request);
    }
}
