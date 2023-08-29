<?php

use App\Http\Controllers\AsyncController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.admin')->group(function () {
    Route::get('async/permissions', [AsyncController::class, 'permissions'])->name('async.permissions');
    Route::get('async/roles-admin', [AsyncController::class, 'rolesAdmin'])->name('async.roles.admin');
    Route::get('async/roles-blog', [AsyncController::class, 'rolesBlog'])->name('async.roles.blog');
});

