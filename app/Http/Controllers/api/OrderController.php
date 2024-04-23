<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function showOrders(Request $request)
    {
        // Récupérer l'ID de l'utilisateur connecté
        $userID = $request->input('id_user');

        // Récupérer toutes les commandes de l'utilisateur connecté avec leurs produits associés
        $orders = Order::where("user", $userID)
            ->whereIn('status', ['en location', 'rendu'])
            ->with(['rentables', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(5);

        if ($orders->count() > 0) {
            // Renvoyer les commandes sous la clé 'data'
            return response()->json([
                'data' => $orders->items(),
            ]);
        } else {
            // Renvoyer une erreur s'il n'y a pas de commandes
            return response()->json([
                'error' => 'Aucune commande trouvée',
            ], 401);
        }
    }
}
