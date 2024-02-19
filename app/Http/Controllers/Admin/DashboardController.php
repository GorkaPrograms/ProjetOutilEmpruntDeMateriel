<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

    public function rentables(){
        return view('admin.manage-rentables');
    }

    public function orders(){
        return view('admin.manage-orders');
    }
}
