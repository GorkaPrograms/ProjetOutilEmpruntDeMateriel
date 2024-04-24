<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\OrderController;
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
    Route::get('/order/cart', [CartController::class, 'view'])->name('order.cart');
    Route::get('/order/order_validate', [OrderController::class, 'view'])->name('order.order_validate');
    Route::get('/order/my-orders', [OrderController::class, 'showMyOrders'])->name('my.orders');

    Route::get('/user',function (){
        dump(\Illuminate\Support\Facades\Auth::user());
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('Login.logout');

    //routes pour l'ajout ou la suppression de produit dans le panier
    Route::post('/order/cart/addQuantityToProduct', [CartController::class, 'addQuantityToProduct'])->name('addQuantityToProduct');
    Route::post('/order/cart/removeQuantityToProduct', [CartController::class, 'removeQuantityToProduct'])->name('removeQuantityToProduct');
    Route::post('/order/cart/add-product-cart', [CartController::class, 'addProductToCart'])->name('cart.add-product');
    Route::post('/order/cart/remove-product-cart', [CartController::class, 'removeProductToCart'])->name('cart.remove-product');

    //route pour la validation de la location
    Route::put('/order/order_validate/validate/{id}',[OrderController::class, 'validateOrder'])->name('order.validateOrder');
    Route::put('/order/order_return/{id}',[OrderController::class, 'returnOrder'])->name('order.returnOrder');




});

require __DIR__.'/auth.php';



