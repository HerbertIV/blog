<?php

use App\Http\Controllers\Blog\BlogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('blogs', [BlogsController::class, 'index'])->name('api.blogs.index');
Route::get('blogs/{id}', [BlogsController::class, 'show'])->name('api.blogs.show');

