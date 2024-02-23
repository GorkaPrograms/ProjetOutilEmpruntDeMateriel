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
            'isAdmin' => ['nullable','boolean']
        ]);

        $validated['employee_code'] = $this->ticket_number();

        $validated['is_admin'] = $request->has('isAdmin');

        unset($validated['isAdmin']);

        //Hash::make($validated['password'])

        User::create($validated);

        return redirect()->back()->withStatus('Inscription réussie');
    }

    private function ticket_number()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (User::where("employee_code", "=", $code)->first());

        return $code;
    }

    public function updateUser(Request $request, User $user){
        $validated = $request->validate([
            'first_name' => ['required','string','between:2,30'],
            'last_name' => ['required','string','between:2,30'],
            'isAdmin' => ['nullable','boolean']
        ]);

        $validated['is_admin'] = $request->has('isAdmin');

        unset($validated['isAdmin']);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'is_admin' => $validated['is_admin']
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
