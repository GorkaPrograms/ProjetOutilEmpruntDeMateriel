<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Rentable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function viewItemsInCart(Request $request){
        $productsArray = $request->productInCart;

        return response()->json($productsArray);
       //foreach($productsArray as $product){
       //    $rentable = Rentable::where('id', $product->id);
       //}
    }
}
