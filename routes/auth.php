<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthAdmin\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('admin/login', [LoginController::class, 'view'])->name('Admin.Login.View');

    Route::post('/login/store', [LoginController::class, 'store'])->name('Admin.Login.Store')->
    middleware('throttle:5,1');
});


Route::middleware('auth')->group(function(){
    //Users
    Route::get('/admin/dashboard/users', [DashboardController::class, 'view'])->name('Dashboard.view');
    Route::post('/admin/dashboard/users/add', [DashboardController::class, 'addUser'])->name('user.add');
    Route::delete('admin/dashboard/users/delete/{user}', [DashboardController::class, 'deleteUser'])->name('user.delete');
    Route::patch('admin/dashboard/users/update/{user}', [DashboardController::class, 'updateUser'])->name('user.update');
    //Rentables
    Route::get('/admin/dashboard/rentables', [DashboardController::class, 'rentables'])->name('dashboard.rentables');
    //Orders
    Route::get('/admin/dashboard/orders', [DashboardController::class, 'orders'])->name('dashboard.orders');

    Route::post('admin/logout', [LoginController::class, 'logout'])->name('Admin.Logout');
});



