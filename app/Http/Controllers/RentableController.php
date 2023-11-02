<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use App\Models\Rentable;

class RentableController extends Controller
{
    public function index(Request $request):View{
        $rentables = Rentable::query();


        if ($search = $request->search) {
            $rentables->where(fn (Builder $query) => $query
                ->where('rentable_name', 'LIKE', '%' . $search . '%')
            );
        }

        return view('home',[
            'rentables' => $rentables->latest()->paginate(9)
        ]);
    }


}
