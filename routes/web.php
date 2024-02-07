<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index']);
Route::post('/authenticated', [AuthController::class, 'isAuthenticated']);

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    
    Route::post('register', [AuthController::class, 'storeRegister']);
    Route::post('login', [AuthController::class, 'storeLogin']);
    Route::post('forgot-password', [AuthController::class, 'storeForgotPassword'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    Route::any('logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('dashboard', [FrontendController::class, 'dashboard'])->name('dashboard');
    
    // Admin Routes
    Route::redirect('admin', 'admin/dashboard');
    Route::prefix('admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Blog
        Route::prefix('blog')->group(function () {
            Route::apiResource('categories', CategoryController::class)->except('show');
            Route::put('categories/{id}/restore', [CategoryController::class, 'restore']);
            Route::delete('categories/{id}/permanent', [CategoryController::class, 'permanentDelete']);
            
            Route::apiResource('tags', TagController::class)->except('show');
            Route::put('tags/{id}/restore', [TagController::class, 'restore']);
            Route::delete('tags/{id}/permanent', [TagController::class, 'permanentDelete']);
        });
    });
});