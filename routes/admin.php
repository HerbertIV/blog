<?php

use App\Http\Controllers\Auth\Admin\AuthController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::middleware('guest')->group(function () {
        Route::get('/', [AuthController::class, 'create'])
            ->name('admin-login');
        Route::post('/', [AuthController::class, 'store']);
    });
    Route::middleware('auth.admin')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])
            ->name('admin-logout');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RolesController::class, 'index'])->name('roles.index');
            Route::get('/create', [RolesController::class, 'create'])->name('roles.create');
            Route::post('/create', [RolesController::class, 'store'])->name('roles.store');
            Route::get('/{role}', [RolesController::class, 'show'])->name('roles.show');
            Route::get('/{role}/edit', [RolesController::class, 'edit'])->name('roles.edit');
            Route::delete('/{role}', [RolesController::class, 'destroy'])->name('roles.delete');
        });
    });
});
require __DIR__.'/async.php';
