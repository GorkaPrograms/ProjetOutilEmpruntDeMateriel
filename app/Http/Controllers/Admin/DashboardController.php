<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function View(){
        if (Auth::user()->is_admin) {
            return view('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function home(){
        return view('home');
    }
}
