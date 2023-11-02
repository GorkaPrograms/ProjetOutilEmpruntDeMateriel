<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function adminView():View{
        return view('admin.dashboard');
    }

    public function home():View{
        return view('home');
    }
}
