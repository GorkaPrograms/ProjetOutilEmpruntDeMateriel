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
            return view('admin.dashboard');
        }
    }

    public function home(){
        return view('home');
    }
}
