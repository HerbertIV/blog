<?php

use App\Http\Controllers\AsyncController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth.admin')->group(function () {
    Route::get('async/permissions', [AsyncController::class, 'permissions'])->name('async.permissions');
//});

