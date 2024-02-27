<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'users' => $users->latest()->get()
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
            'rentables' => $rentables->latest()->get()
        ]);
    }

    public function addRentable(Request $request){
        $validated = $request->validate([
            'name' => ['required','string','between:2,50'],
            'type' => ['required','string','between:2,60'],
            'quantity' => ['required', 'integer', 'min:1']
        ]);

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
            'quantity' => ['required','integer','min:1']
        ]);

        $rentable->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'quantity' => $validated['quantity']
        ]);

        return redirect()->back()->withStatus('Produit modifié avec succès');
    }



    ////////////////////
    //Routes des orders
    ///////////////////



    public function orders(){
        return view('admin.manage-orders');
    }
}
