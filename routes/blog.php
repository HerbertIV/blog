<?php

use App\Http\Controllers\Auth\Blog\AuthController;
use App\Http\Controllers\Blog\HomepageController;
use Illuminate\Support\Facades\Route;


Route::get('index', [HomepageController::class, 'index']);
//Route::middleware('guest')->group(function () {
//    Route::get('login', [AuthController::class, 'create'])
//                ->name('blog-login');
//    Route::post('login', [AuthController::class, 'store']);
//});
//
//Route::middleware('auth')->group(function () {
//    Route::post('logout', [AuthController::class, 'destroy'])
//                ->name('blog-logout');
//});
