<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Rentable;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RentableController;
use App\Http\Controllers\CartController;
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

    Route::get('/', [LoginController::class, 'view'])->name('Login.View');

    Route::post('/login', [LoginController::class, 'login'])->name('Login.Login');
});

Route::middleware('auth')->group(function(){
    Route::get('/home', [RentableController::class, 'index'])->name('home');
    Route::post('/add-product-cart', [CartController::class, 'addProductToCart'])->name('cart.add-product');
    Route::get('/order/cart', [OrderController::class, 'view'])->name('order.cart');

    Route::get('/user',function (){
        dump(\Illuminate\Support\Facades\Auth::user());
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('Login.logout');

});

require __DIR__.'/auth.php';



