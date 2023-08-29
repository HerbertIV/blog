<?php

use App\Http\Controllers\Auth\Blog\AuthController;
use App\Http\Controllers\Blog\BlogsController;
use App\Http\Controllers\Blog\HomepageController;
use Illuminate\Support\Facades\Route;


Route::get('index', [HomepageController::class, 'index']);
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'renderLogin'])
        ->name('blog-login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('blog-login.store');
    Route::get('/register', [AuthController::class, 'renderRegister'])
        ->name('blog-register');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('blog-register.store');
    Route::get('/reset-password', [AuthController::class, 'renderInitResetPassword'])
        ->name('blog-reset-password-init');
    Route::post('/reset-password', [AuthController::class, 'resetPasswordInit'])
        ->name('blog-reset-password-init.store');
    Route::get('/reset-password/{token}', [AuthController::class, 'renderResetPassword'])
        ->name('blog-reset-password');
    Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword'])
        ->name('blog-reset-password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])
                ->name('blog-logout');
});

Route::get('/', [HomepageController::class, 'render'])
    ->name('homepage');
Route::get('/{blog}', [BlogsController::class, 'show'])
    ->name('blog-blogs.show');
