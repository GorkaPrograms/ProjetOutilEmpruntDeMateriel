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
        // Récupérer l'ID de l'utilisateur connecté
        $userID = Auth::id();

        // Récupérer toutes les commandes de l'utilisateur connecté avec leurs produits associés
        $orders = Order::where("user", $userID)
            ->whereIn('status', ['en location', 'rendu'])
            ->with(['rentables', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(5);

        if (!$orders) {
            return response()->json(['error' => 'Événement non trouvé'], 404);
        }

        if ($search = $request->search) {
            $orders->where(fn (Builder $query) => $query
                ->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%')
                ->orWhere('comeback_date', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
            );
        }

        return view('order.my-orders', [
            'orders' => $orders
        ]);
    }

    public function validateOrder(Request $request, $id){
        $order = Order::findOrFail($id);

        $order->status = "En location";
        $order->comeback_date = $request->input('comeback_date');
        $order->save();

        // Supprimer l'ordre de la session
        Session::forget('order');

        // Supprimer rentables de la session
        $request->session()->forget('rentables');

        return redirect()->route('home')->withStatus('Location réalisée avec succès');
    }

    public function returnOrder(Request $request, $id){
        $order = Order::findOrFail($id);

        $order->status = "Rendu";
        $order->save();

        $orderNumber = $order->id;

        return redirect()->route('my.orders')->withStatus("Location numéro $orderNumber rendu avec succès");

    }


}
