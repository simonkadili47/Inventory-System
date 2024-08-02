<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Public Routes
Route::get('/', function () {
    return view('login');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes with Authentication and Admin Middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');

    Route::get('view_category', [AdminController::class, 'view_category']);
    Route::post('add_category', [AdminController::class, 'add_category']);
    Route::get('list_category', [AdminController::class, 'list_category']);
    Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('edit_category/{id}', [AdminController::class, 'edit_category']);
    Route::post('update_category/{id}', [AdminController::class, 'update_category']);

    Route::get('view_product', [AdminController::class, 'view_product']);
    Route::post('add_product', [AdminController::class, 'add_product']);
    Route::get('list_product', [AdminController::class, 'list_product']);
    Route::get('delete_product/{id}', [AdminController::class, 'delete_product']);
    Route::get('edit_product/{id}', [AdminController::class, 'edit_product']);
    Route::post('update_product/{id}', [AdminController::class, 'update_product']);

    Route::get('admin_dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');

    Route::get('view_sales', [AdminController::class, 'view_sales']);
    Route::post('add_sales', [AdminController::class, 'add_sales']);
    Route::get('list_sales', [AdminController::class, 'list_sales']);
    Route::get('delete_sales/{id}', [AdminController::class, 'delete_sales']);
    Route::get('edit_sales/{id}', [AdminController::class, 'edit_sales']);
    Route::post('update_sales/{id}', [AdminController::class, 'update_sales']);

    Route::get('view_users', [AdminController::class, 'view_users']);
    Route::post('add_users', [AdminController::class, 'add_users']);
    Route::get('list_users', [AdminController::class, 'list_users']);
    Route::get('delete_user/{id}', [AdminController::class, 'delete_user']);
    Route::get('edit_user/{id}', [AdminController::class, 'edit_user']);
    Route::post('update_user/{id}', [AdminController::class, 'update_user']);
});

// User Routes with Authentication and User Middleware
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('user/dashboard', [HomeController::class, 'user_dashboard'])->name('user.dashboard');

    Route::get('view_sales', [UserController::class, 'view_sales'])->name('user.view_sales');
    Route::post('add_sales', [UserController::class, 'add_sales'])->name('user.add_sales');
    Route::get('list_sales', [UserController::class, 'list_sales'])->name('user.list_sales');
    Route::delete('delete_sales/{id}', [UserController::class, 'delete_sales'])->name('user.delete_sales');
    Route::get('edit_sales/{id}', [UserController::class, 'edit_sales'])->name('user.edit_sales');
    Route::put('update_sales/{id}', [UserController::class, 'update_sales'])->name('user.update_sales');

    Route::post('user/logout', [UserController::class, 'Userlogout'])->name('user.logout');
});

require __DIR__.'/auth.php';
