<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function View(){
        if (Auth::user()->is_admin) {
            $users = User::all();
            return view('admin.dashboard', compact('users'));
        }
        else{
            return view('home');
        }
    }

    public function home(){
        return view('home');
    }

    //Routes des users

    public function addUser(Request $request):RedirectResponse{
        $validated = $request->validate([
            'first_name' => ['required','string','between:2,30'],
            'last_name' => ['required','string','between:2,30'],
            'employee_code' => ['required', 'integer', ]
        ]);

        User::create($validated);

        return redirect()->back()->withStatus('Inscription réussie');
    }

    public function updateUser(Request $request, User $user){
        $validated = $request->validate([
            'first_name' => ['required','string','between:2,30'],
            'last_name' => ['required','string','between:2,30'],
        ]);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
        ]);

        return redirect()->route('Dashboard.view')->withStatus('Utilisateur modifié avec succès');
    }

    public function deleteUser(User $user){
        $user->delete();
        return redirect()->back()->withStatus('Utilisateur supprimé');
    }

    //Routes des rentables

    public function rentables(){
        return view('admin.manage-rentables');
    }

    //Routes des orders

    public function orders(){
        return view('admin.manage-orders');
    }
}
