<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\AuthController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::middleware('auth.admin')->group(function () {
        Route::post('logout', [AuthController::class, 'destroy'])
            ->name('admin-logout');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RolesController::class, 'index'])
                ->name('roles.index');
            Route::get('/create', [RolesController::class, 'create'])
                ->name('roles.create');
            Route::get('/{role}', [RolesController::class, 'show'])
                ->name('roles.show');
            Route::get('/{role}/edit', [RolesController::class, 'edit'])
                ->name('roles.edit');
            Route::delete('/{role}', [RolesController::class, 'destroy'])
                ->name('roles.delete');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])
                ->name('users.index');
            Route::get('/{user}', [UserController::class, 'show'])
                ->name('users.show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])
                ->name('users.edit');
        });
        Route::group(['prefix' => 'admins'], function () {
            Route::get('/', [AdminController::class, 'index'])
                ->name('admins.index');
            Route::get('/create', [AdminController::class, 'create'])
                ->name('admins.create');
            Route::get('/{admin}', [AdminController::class, 'show'])
                ->name('admins.show');
            Route::get('/{admin}/edit', [AdminController::class, 'edit'])
                ->name('admins.edit');
            Route::delete('/{admin}', [AdminController::class, 'destroy'])
                ->name('admins.delete');
        });
        Route::group(['prefix' => 'blogs'], function () {
            Route::get('/', [BlogsController::class, 'index'])
                ->name('blogs.index');
            Route::get('/create', [BlogsController::class, 'create'])
                ->name('blogs.create');
            Route::get('/{blog}', [BlogsController::class, 'show'])
                ->name('blogs.show');
            Route::get('/{blog}/edit', [BlogsController::class, 'edit'])
                ->name('blogs.edit');
            Route::delete('/{blog}', [BlogsController::class, 'destroy'])
                ->name('blogs.delete');
        });
    });
    Route::middleware('guest.admin')->group(function () {
        Route::get('/', [AuthController::class, 'create'])
            ->name('admin-login');
        Route::post('/', [AuthController::class, 'store']);
        Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordRender'])->name('auth.reset-password-render');
        Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('auth.reset-password');
    });
});
require __DIR__.'/async.php';
