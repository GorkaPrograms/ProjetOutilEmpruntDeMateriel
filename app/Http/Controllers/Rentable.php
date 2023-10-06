<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class Rentable extends Controller
{
    public function view():View{
        return view('Admin.dashboard');
    }
}
