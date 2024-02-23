<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function view(){
        // Récupérer l'ordre de la session
        $order = Session::get('order');

        // Créer un nouvel ordre s'il n'existe pas déjà dans la session
        if (!$order) {
            $order = new Order();
            $order->user = Auth::user()->id;
            $order->status = 'creation panier';
            $order->save();

            // Stocker le nouvel ordre dans la session
            Session::put('order', $order);
        }

        $rentablesArray = Session::get('rentables');

        // Pour chaque produit dans le panier
        foreach ($rentablesArray as $rentable) {
            // Vérifier si une location identique existe déjà pour ce produit dans cet ordre
            $existingLocation = Location::where('order_reference', $order->id)
                ->where('rentable', $rentable['id'])
                ->first();

            // Si aucune location identique n'existe, en créer une nouvelle
            if (!$existingLocation) {
                $location = new Location();
                $location->order_reference = $order->id;
                $location->rentable = $rentable['id'];
                $location->quantity = $rentable['quantity'];
                $location->save();
            }
        }

        return view('order.cart',[
            'items' => $rentablesArray
        ]);
    }
}
