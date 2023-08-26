<?php

use App\Http\Controllers\Auth\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('admin', [AuthController::class, 'create'])
                ->name('admin-login');
    Route::post('admin', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])
                ->name('admin-logout');
});
