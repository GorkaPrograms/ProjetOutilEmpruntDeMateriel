<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AuthAdmin\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticated;

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [LoginController::class, 'view'])->name('AdminMiddleware.Login.View');

    Route::post('/login/store', [LoginController::class, 'store'])->name('AdminMiddleware.Login.Store')->
    middleware('throttle:5,1');
});


Route::middleware('auth')->group(function(){

    Route::post('admin/logout', [LoginController::class, 'logout'])->name('AdminMiddleware.Logout');

    //Connexion espace admin
    Route::post('/admin/verify-password', [AdminLoginController::class, 'verifyAdminPassword'])->name('admin.verify.password');
    Route::get('/admin/check-password', [AdminLoginController::class, 'view'])->name('admin.check.password');
});

Route::middleware(['auth', 'admin.auth'])->group(function(){

    //Users
    Route::get('/admin/dashboard/users', [DashboardController::class, 'view'])->name('Dashboard.view');
    Route::post('/admin/dashboard/users/add', [DashboardController::class, 'addUser'])->name('user.add');
    Route::delete('admin/dashboard/users/delete/{user}', [DashboardController::class, 'deleteUser'])->name('user.delete');
    Route::patch('admin/dashboard/users/update/{user}', [DashboardController::class, 'updateUser'])->name('user.update');
    //Rentables
    Route::get('/admin/dashboard/rentables', [DashboardController::class, 'rentables'])->name('dashboard.rentables');
    Route::post('/admin/dashboard/rentables/add', [DashboardController::class, 'addRentable'])->name('rentable.add');
    Route::delete('admin/dashboard/rentables/delete/{rentable}', [DashboardController::class, 'deleteRentable'])->name('rentable.delete');
    Route::patch('admin/dashboard/rentables/update/{rentable}', [DashboardController::class, 'updateRentable'])->name('rentable.update');
    //Orders
    Route::get('/admin/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');
    Route::delete('admin/dashboard/orders/delete/{order}', [DashboardController::class, 'deleteOrder'])->name('order.delete');
    Route::put('admin/dashboard/orders/update/{id}', [DashboardController::class, 'updateOrder'])->name('order.update');

    Route::get('/getData/{id}', [DashboardController::class, 'getData']);
});



