<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use App\Models\Rentable;

class RentableController extends Controller
{
    public function getAllRentable(){
        $rentables = Rentable::all();

        return response()->json($rentables);
    }


}
