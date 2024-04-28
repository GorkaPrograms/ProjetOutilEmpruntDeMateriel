<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Rentable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function showOrders(Request $request)
    {
        // Récupérer l'ID de l'utilisateur connecté
        $userID = $request->input('id_user');

        // Récupérer toutes les commandes de l'utilisateur connecté avec leurs produits associés
        $orders = Order::where("user", $userID)
            ->whereIn('status', ['En location', 'Rendu'])
            ->with(['rentables', 'user'])
            ->orderBy('id', 'desc')
            ->paginate();

        if ($orders->count() > 0) {
            // Renvoyer les commandes sous la clé 'data'
            return response()->json([
                'data' => $orders->items(),
            ]);
        } else {
            // Renvoyer une erreur s'il n'y a pas de commandes
            return response()->json([
                'error' => 'Aucune commande trouvée',
            ], 404);
        }
    }


    public function validateOrder(Request $request){
        $userID = $request->id_user;

        $order = new Order();
        $order->user = $userID;
        $order->status = 'En location';
        $comebackDate = $request->input('comeback_date');
        $order->comeback_date = date('Y-m-d', strtotime($comebackDate));
        $order->save();

        // Récupérer `productInCart` depuis la requête
        $productInCart = $request->input('productInCart');

        // Décoder `productInCart` en un tableau d'entiers
        if (!is_array($productInCart)) {
            $productInCart = json_decode($productInCart, true);
        }

        // Initialiser un tableau pour compter les quantités de chaque produit
        $quantities = array_count_values($productInCart);

        // Traiter chaque ID de produit individuellement
        foreach ($quantities as $productId => $quantity) {
            // Rechercher une location existante pour l'ordre et le produit donné
            $existingLocation = Location::where('order_reference', $order->id)
                ->where('rentable', $productId)
                ->first();

            // Si la location existe, mettre à jour la quantité
            if ($existingLocation) {
                $existingLocation->quantity += $quantity;
                $existingLocation->save();
            } else {
                // Sinon, créer une nouvelle location pour le produit
                $newLocation = new Location();
                $newLocation->order_reference = $order->id;
                $newLocation->rentable = $productId;
                $newLocation->quantity = $quantity;
                $newLocation->save();
            }
        }

        return response()->json(['success' => 'Location effectuée']);
    }

    public function returnOrder(Request $request){
        $id = $request->input('orderId');

        $order = Order::findOrFail($id);

        $productQuantities = [];

        $rentables = $order->rentables;

        foreach ($rentables as $rentable) {
            $productQuantities[] = [
                'product_id' => $rentable->id, // ID du produit
                'quantity' => $rentable->pivot->quantity // Quantité liée à la commande (via la relation pivot)
            ];
        }

        foreach ($productQuantities as $productQuantity) {
            $product = Rentable::find($productQuantity['product_id']);
            $product->quantity += $productQuantity['quantity'];
            $product->save();
        }

        $order->status = "Rendu";
        $order->save();

        return response()->json(['success' => 'Location numéro rendu avec succès']);
    }
}
