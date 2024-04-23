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
        $arrayCount = array_count_values($productsArray);

        $rentablesArray = Rentable::whereIn('id', $productsArray)->get();
        $rentablesArray = $rentablesArray->map(function (Rentable $rentable) use ($arrayCount) {
            $rentable['quantity_cart'] = $arrayCount[$rentable->id];
            return $rentable;
        });

        return response()->json($rentablesArray);
    }

    public function addQuantityToProduct(Request $request){
        // Récupérer `productInCart` depuis la requête
        $productInCart = $request->input('productInCart');

        // Décoder `productInCart` en un tableau d'entiers
        if (!is_array($productInCart)) {
            $productInCart = json_decode($productInCart, true);
        }

        $quantities = array_count_values($productInCart);

        $productId = $request->input('product_to_add');

        if ($this->checkQuantityAvailable($productId, $quantities[$productId])) {
            $rentable = Rentable::findOrFail($productId);
            $rentable->update([
                'quantity' => $rentable->quantity - 1
            ]);
        } else {
            return response()->json(['error' => 'Nous ne disposons pas de plus de quantité pour ce produit']);
        }

        return response()->json(['success' => 'Ajout dans le panier effectué']);
    }

    public function addProductToCart(Request $request) {
        $productId = $request->input('product_to_add');

        $productInCart = $request->input('productInCart');

        // Décoder `productInCart` en un tableau d'entiers
        if (!is_array($productInCart)) {
            $productInCart = json_decode($productInCart, true);
        }

        // Créer un tableau pour stocker les quantités de chaque produit dans le panier
        $quantities = array_count_values($productInCart);

        if ($this->checkQuantityAvailable($productId, $quantities[$productId])) {
            $rentable = Rentable::findOrFail($productId);
            $rentable->update([
                'quantity' => $rentable->quantity - 1
            ]);
            return response()->json(['success' => 'Ajout dans le panier effectué']);
        } else {
            return response()->json(['error' => 'Nous ne disposons pas de plus de quantité pour ce produit']);
        }
    }


    private function checkQuantityAvailable($productId, $quantity) {
        $rentable = Rentable::findOrFail($productId);
        if($rentable->quantity > 0){
            return true;
        }else{
            return false;
        }

        //return $rentable->quantity > $quantity;
    }

    public function removeQuantityToProduct(Request $request)
    {
        $productId = $request->input('product_to_remove');

        $rentable = Rentable::find($productId);
        $rentable->update([
            'quantity' => $rentable->quantity + 1
        ]);

        return response()->json(['success' => 'Une quantité a été retiré avec succès']);
    }

    public function removeProductToCart(Request $request){
        $productId = $request->input('product_to_remove');

        $numberOfProduct = $request->input('numberOfProductsRemoved');
        $rentable = Rentable::find($productId);
        $rentable->update([
            'quantity' => $rentable->quantity + $numberOfProduct
        ]);

        return response()->json(['success' => 'Toutes les quantitées ont été retiré avec succès']);
    }
}
