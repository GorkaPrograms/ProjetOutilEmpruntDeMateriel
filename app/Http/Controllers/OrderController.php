<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view(){
        return view('order.cart',[
            'items' => ['Item','2',]
        ]);
    }
}
