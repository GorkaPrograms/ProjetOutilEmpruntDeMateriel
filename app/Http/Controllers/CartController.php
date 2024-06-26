<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use App\Models\Rentable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isEmpty;

class CartController extends Controller
{
    public function view(){
        // Récupérer l'ordre de la session
        $order = Session::get('order');

        // Créer un nouvel ordre s'il n'existe pas déjà dans la session
        if (!$order) {
            $order = new Order();
            $order->user = Auth::user()->id;
            $order->status = 'Création panier';
            $order->save();

            // Stocker le nouvel ordre dans la session
            Session::put('order', $order);
        }

        $rentablesArray = Session::get('rentables');



        if(!empty($rentablesArray)) {
            // Créer un tableau pour stocker les quantités de chaque produit dans le panier
            $quantites = array_count_values(array_column($rentablesArray, 'id'));

            // Pour chaque produit dans le panier
            foreach ($rentablesArray as $rentable) {
                // Rechercher une location correspondante dans la base de données
                $existingLocation = Location::where('order_reference', $order->id)
                    ->where('rentable', $rentable['id'])
                    ->first();

                // Si une location correspondante est trouvée
                if ($existingLocation) {
                    // Ajouter la quantité de produits identiques pour cet enregistrement
                    $existingLocation->quantity = $quantites[$rentable['id']];
                    $existingLocation->save();
                } else {
                    // Sinon, créer une nouvelle location avec la quantité de produits identiques
                    $location = new Location();
                    $location->order_reference = $order->id;
                    $location->rentable = $rentable['id'];
                    $location->quantity = $quantites[$rentable['id']];
                    $location->save();
                }
            }
        }

        // Récupère les colonnes 'name' de la table 'rentables'
        // et 'quantity' de la table 'locations' via une jointure
        $rentablesItems = Location::select('rentables.name', 'locations.quantity','locations.rentable','rentables.image')
            ->join('rentables', 'locations.rentable', '=', 'rentables.id')
            ->where('locations.order_reference', $order->id)
            ->get();

        return view('order.cart',[
            'items' => $rentablesItems
        ]);
    }

    public function addQuantityToProduct(Request $request){
        $rentablesArray = Session::get('rentables');

        // Créer un tableau pour stocker les quantités de chaque produit dans le panier
        $quantites = array_count_values(array_column($rentablesArray, 'id'));

        $productId = $request->input('product_to_add');

        if ($this->checkQuantityAvailable($productId, $quantites[$productId])) {
            $rentable = Rentable::findOrFail($productId);
            $request->session()->push('rentables', $rentable);
            $rentable->update([
                'quantity' => $rentable->quantity - 1
            ]);
        } else {
            $rentable = Rentable::findOrFail($productId);
            $rentableName = $rentable->name;
            return redirect('/order/cart')->with(['outOfQuantity' => "Nous ne disposons pas de plus de quantité pour $rentableName"]);
        }

        return redirect()->route('order.cart');
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

    private function checkQuantityAvailableInCart($productId, $quantity) {
        $rentable = Rentable::findOrFail($productId);
        if($rentable->quantity > 0){
            return true;
        }else{
            return false;
        }

        //return $rentable->quantity >= $quantity;
    }

    public function removeQuantityToProduct(Request $request)
    {
        // Récupérer l'ID du produit à retirer
        $productId = $request->input('product_to_remove');

        // Récupérer la session 'rentables'
        $rentablesArray = $request->session()->get('rentables');

        // Vérifier si le produit à retirer existe dans rentablesArray
        $productExists = false;

        // Parcourir la session pour trouver le produit à retirer
        foreach ($rentablesArray as $key => $rentable) {
            if ($rentable['id'] == $productId) {
                // Supprimer l'élément correspondant de la session
                unset($rentablesArray[$key]);
                $productExists = true; // Marquer que le produit existe
                break; // Sortir de la boucle une fois que le produit est trouvé
            }
        }

        // Mettre à jour la session 'rentables'
        $request->session()->put('rentables', $rentablesArray);

        // Vérifier si tous les produits correspondants ont été supprimés de rentablesArray
        $isAllProductsRemoved = true;
        foreach ($rentablesArray as $rentable) {
            if ($rentable['id'] == $productId) {
                $isAllProductsRemoved = false;
                break;
            }
        }

        $order = Session::get('order');

        // Si tous les produits correspondants ont été supprimés de rentablesArray, supprimer la ligne correspondante dans la table locations
        if ($isAllProductsRemoved) {
            Location::where('order_reference', $order->id)
                ->where('rentable', $productId)
                ->delete();
        }

        $rentable = Rentable::find($productId);
        $rentable->update([
            'quantity' => $rentable->quantity + 1
        ]);

        return redirect()->route('order.cart');
    }

    public function removeProductToCart(Request $request){
        // Récupérer l'ID du produit à retirer
        $productId = $request->input('product_to_remove');

        // Récupérer la session 'rentables'
        $rentablesArray = $request->session()->get('rentables');

        // Supprimer tous les produits avec le même ID de rentablesArray
        $updatedRentablesArray = array_filter($rentablesArray, function ($rentable) use ($productId) {
            return $rentable['id'] != $productId;
        });

        // Mettre à jour la session 'rentables' avec le nouveau tableau sans les produits à retirer
        $request->session()->put('rentables', $updatedRentablesArray);

        // Supprimer toutes les lignes correspondantes dans la table locations pour ce produit
        $order = Session::get('order');
        $location = Location::where('order_reference', $order->id)
            ->where('rentable', $productId)->first();
        $rentable = $location->rentable()->first();

        $rentable->update([
           'quantity' => $rentable->quantity + $location->quantity
        ]);

        $location->delete();

        return redirect()->route('order.cart');
    }

    public function addProductToCart(Request $request) {
        $productId = $request->input('product_to_add');

        $rentable = Rentable::findOrFail($productId);
        $request->session()->push('rentables', $rentable);

        $rentablesArray = Session::get('rentables');

        // Créer un tableau pour stocker les quantités de chaque produit dans le panier
        $quantites = array_count_values(array_column($rentablesArray, 'id'));

        if ($this->checkQuantityAvailableInCart($productId, $quantites[$productId])) {
            $rentable->update([
                'quantity' => $rentable->quantity - 1
            ]);
            return redirect()->route('home');
        } else {
            array_pop($rentablesArray);
            $request->session()->put('rentables', $rentablesArray);
            $rentableName = $rentable->name;
            return redirect('/home')->with(['outOfQuantity' => "Nous ne disposons pas de plus de quantité pour $rentableName"]);
        }
    }

}
