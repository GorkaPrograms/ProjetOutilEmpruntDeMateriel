<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rentable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addProductToCart(Request $request) {
        $rentable = Rentable::findOrFail($request->input('product_to_add'));
        $request->session()->push('rentables', $rentable);

        return redirect()->route('home');
    }
}
