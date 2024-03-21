<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rentable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    //public function View(Request $request){
    //    if (Auth::user()->is_admin) {
    //        $users = User::all();

    //        return view('admin.dashboard', compact('users'));
    //    }
    //    else{
    //        return view('home');
    //    }
    //}

    public function home(){
        return view('home');
    }



    ///////////////////
    //Routes des users
    ///////////////////



    public function view(Request $request):View{
        $users = User::query();

        if ($search = $request->search) {
            $users->where(fn (Builder $query) => $query
                ->where('employee_code', 'LIKE', '%' . $search . '%')
                ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
            );
        }

        return view('admin.dashboard',[
            'users' => $users->latest()->paginate(10)
        ]);
    }

    public function addUser(Request $request):RedirectResponse{
        $validated = $request->validate([
            'first_name' => ['required','string','between:2,30'],
            'last_name' => ['required','string','between:2,30'],
            'isAdmin' => ['nullable','boolean']
        ]);

        $validated['employee_code'] = $this->ticket_number();

        $validated['is_admin'] = $request->has('isAdmin');

        unset($validated['isAdmin']);

        //Hash::make($validated['password'])

        User::create($validated);

        return redirect()->back()->withStatus('Inscription réussie');
    }

    private function ticket_number()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (User::where("employee_code", "=", $code)->first());

        return $code;
    }

    public function updateUser(Request $request, User $user){
        $validated = $request->validate([
            'first_name' => ['required','string','between:2,30'],
            'last_name' => ['required','string','between:2,30'],
            'isAdmin' => ['nullable','boolean']
        ]);

        $validated['is_admin'] = $request->has('isAdmin');

        unset($validated['isAdmin']);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'is_admin' => $validated['is_admin']
        ]);

        return redirect()->route('Dashboard.view')->withStatus('Utilisateur modifié avec succès');
    }

    public function deleteUser(User $user){
        $user->delete();
        return redirect()->back()->withStatus('Utilisateur supprimé');
    }



    //////////////////////
    //Routes des rentables
    //////////////////////



    public function rentables(Request $request):View{
        $rentables = Rentable::query();

        if ($search = $request->search) {
            $rentables->where(fn (Builder $query) => $query
                ->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('quantity', 'LIKE', '%' . $search . '%')
                ->orWhere('type', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
            );
        }

        return view('admin.manage-rentables',[
            'rentables' => $rentables->latest()->paginate(10)
        ]);
    }

    public function addRentable(Request $request){
        $validated = $request->validate([
            'name' => ['required','string','between:2,50'],
            'type' => ['required','string','between:2,60'],
            'quantity' => ['required', 'integer', 'min:1'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif']
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $validated['image'] = 'uploads/' . $imageName;
        }

        Rentable::create($validated);

        return redirect()->route('dashboard.rentables')->withStatus('Produit ajouté');
    }

    public function deleteRentable(Rentable $rentable){
        $rentable->delete();
        return redirect()->route('dashboard.rentables')->withStatus('Produit supprimé');
    }

    public function updateRentable(Request $request, Rentable $rentable){
        $validated = $request->validate([
            'name' => ['required','string','between:2,30'],
            'type' => ['required','string','between:2,30'],
            'quantity' => ['required','integer','min:1'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif']
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $validated['image'] = 'uploads/' . $imageName;
        }

        $rentable->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'image' => $validated['image']
        ]);

        return redirect()->back()->withStatus('Produit modifié avec succès');
    }



    ////////////////////
    //Routes des orders
    ///////////////////



    public function orders(Request $request):View{
        $query = Order::select('orders.id','orders.status','orders.comeback_date','orders.updated_at','orders.created_at','user.first_name','user.last_name')
            ->join('user','user.id', '=' ,'orders.user')
            ->with("rentables");

        if ($search = $request->search) {
            $query->where(function ($query) use ($search) {
                $query->where('user.first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('user.last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('orders.status', 'LIKE', '%' . $search . '%')
                    ->orWhere('orders.id', 'LIKE', '%' . $search . '%');
            });
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.manage-orders',compact('orders'));
    }

    public function getData($id)
    {
        $order = Order::where("id", $id)->with(['rentables', 'user'])->first(); // Récupérer l'événement en fonction de l'ID

        if (!$order) {
            return response()->json(['error' => 'Événement non trouvé'], 404);
        }

        // Retourner les données de l'événement au format JSON
        return response()->json($order);
    }


}
