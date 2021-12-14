<?php

use Illuminate\Http\Request;
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

Route::prefix('/v1')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('/signup', [UsersController::class, 'signUp'])->name('verification.send');
        Route::post('/login', [UsersController::class, 'logWithEmail'])->name('login');
        Route::post('/user-password', [UsersController::class, 'forgotPasswordEmail'])->name('user-password');
    });
});
Route::middleware('auth:sanctum')->group(function () {
    Route::name('users.')->prefix('/users')->group(function () {
        Route::post('/detail/{id}', [UsersController::class, 'detail'])->name('detail');
    });
});