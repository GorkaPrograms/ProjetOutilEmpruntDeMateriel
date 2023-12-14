<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function view(){
        $rentablesArray = Session::get('rentables');

        return view('order.cart',[
            'items' => $rentablesArray
        ]);
    }
}
