<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\RentableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rentable/getAllRentable', [RentableController::class, 'getAllRentable']);
Route::post('/user/login' ,[LoginController::class, 'login']);
