<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/profile', [AuthController::class, 'profile']);
// });

Route::prefix('auth')->group(function () {
    // Customers
    Route::post('/register/customer', [AuthController::class, 'registerCustomer']);
    Route::post('/login/customer', [AuthController::class, 'loginCustomer']);

    // Employees
    Route::post('/register/employee', [AuthController::class, 'registerEmployee']);
    Route::post('/login/employee', [AuthController::class, 'loginEmployee']);

    // Logout (ต้อง Authenticated ก่อน)
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
    Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);
});

