<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;

// Route untuk halaman beranda
Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('/admin')->name('admin.')->group(function () {
    // Login Routes...
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');

    // Protected routes for admin
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('news', NewsController::class);

        // Routes untuk membuat dan menyimpan user baru
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
    });
});

// User Routes
Route::prefix('user')->name('user.')->group(function () {
    // Login Routes...
    Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserController::class, 'login'])->name('login.submit');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    // Protected routes for user
    Route::middleware(['auth:user'])->group(function () {
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::resource('news', NewsController::class)->only(['create', 'store']);
    });
});

// Fallback Route untuk menangani halaman yang tidak ditemukan
// Route::fallback(function () {
//     return response()->view('errors.404', [], 404);
// });
