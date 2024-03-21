<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Rentable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function view(){
        return view('order.order');
    }

    public function showMyOrders(Request $request){
        $user = Auth::user();
        $orders = Order::query()->where('user', $user->id);

        if ($search = $request->search) {
            $orders->where(fn (Builder $query) => $query
                ->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->orWhere('comeback_date', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
            );
        }

        return view('order.my-orders',[
            'orders' => $orders->latest()->paginate(10)
        ]);
    }

    public function validateOrder(Request $request, $id){
        $order = Order::findOrFail($id);

        $order->status = "en location";
        $order->comeback_date = $request->input('comeback_date');
        $order->save();

        //$rentable = Rentable::All();

        $rentablesArray = Session::get('rentables');

        // Créer un tableau pour stocker les quantités de chaque produit dans le panier
        $quantites = array_count_values(array_column($rentablesArray, 'id'));

        // Obtenir les IDs des produits uniques dans le panier
        $rentableIds = array_unique(array_column($rentablesArray, 'id'));

        // Pour chaque produit dans le panier
        foreach ($rentableIds as $rentableId) {
            // Rechercher une location correspondante dans la base de données
            $existingRentable = Rentable::find($rentableId);

            // Si une location correspondante est trouvée
            if ($existingRentable) {
                // Ajouter la quantité de produits identiques pour cet enregistrement
                $existingRentable->quantity -= $quantites[$rentableId];
                $existingRentable->save();
            }
        }

        // Supprimer l'ordre de la session
        Session::forget('order');

        // Supprimer rentables de la session
        $request->session()->forget('rentables');

        return redirect()->route('home');
    }
}
