<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function View():View{
        return view('admin.dashboard',[
            'users' => User::query()->paginate(20)
        ]);
    }

    public function home(){
        return view('home');
    }
}
