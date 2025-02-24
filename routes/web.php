<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomTypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/test-c', function () {
        return 'You are a customer';
    });
});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/test-e', function () {
        return 'You are an employee';
    });

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    //category
    Route::resource('categories', CategoryController::class);
    //RoomType
    Route::resource('roomtypes', RoomTypeController::class);
});



require __DIR__ . '/auth.php';
