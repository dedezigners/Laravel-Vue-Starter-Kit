<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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
    Route::post('upload-image', [FrontendController::class, 'uploadImage']);

    Route::put('profile/update', [ProfileController::class, 'updateProfile']);
    Route::put('profile/change-password', [ProfileController::class, 'updatePassword']);
    
    // Admin Routes
    Route::redirect('admin', 'admin/dashboard');
    Route::prefix('admin')->group(function() {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        Route::get('profile/overview', [ProfileController::class, 'overview']);
        Route::get('profile/edit', [ProfileController::class, 'edit']);
        Route::get('profile/change-password', [ProfileController::class, 'changePassword']);

        Route::apiResource('users', UserController::class)->except('show');
        Route::put('users/{id}/restore', [UserController::class, 'restore']);
        Route::delete('users/{id}/permanent', [UserController::class, 'permanentDelete']);

        // Blog
        Route::prefix('blog')->group(function () {
            Route::apiResource('categories', CategoryController::class)->except('show');
            Route::put('categories/{id}/restore', [CategoryController::class, 'restore']);
            Route::delete('categories/{id}/permanent', [CategoryController::class, 'permanentDelete']);
            
            Route::apiResource('tags', TagController::class)->except('show');
            Route::put('tags/{id}/restore', [TagController::class, 'restore']);
            Route::delete('tags/{id}/permanent', [TagController::class, 'permanentDelete']);
            
            Route::resource('posts', PostController::class)->except('show');
            Route::put('posts/{id}/restore', [PostController::class, 'restore']);
            Route::delete('posts/{id}/permanent', [PostController::class, 'permanentDelete']);
        });
    });
});