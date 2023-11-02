<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Rentable extends Controller
{
    public function getUsers() {
        if (!Auth::user()->is_admin) {
            return redirect()->route('login');
        }
    }

    public function view():View{
        return view('Admin.dashboard');
    }
}
