<?php

use App\Http\Controllers\Rentable;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'create'])->name('Login.create');

    Route::post('/login/store', [LoginController::class, 'login'])->name('Login.store');
});
Route::get('/admin/dashboard', [Rentable::class, 'view'])->name('Dashboard.view');

Route::middleware('auth')->group(function(){
    Route::get('/user',function (){
        dump(\Illuminate\Support\Facades\Auth::user());
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('Login.logout');

    Route::get('/product', function () {
        return view('product');
    })->name('product');

});


