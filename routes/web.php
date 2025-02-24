<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomTypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//category
Route::resource('categories', CategoryController::class);
//RoomType
Route::resource('roomtypes', RoomTypeController::class);

Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // แสดงรายการทั้งหมด
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // ฟอร์มการสร้างสินค้า
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // บันทึกสินค้า
Route::resource('products', ProductController::class);

require __DIR__.'/auth.php';
