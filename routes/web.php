<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EthnicitiesController;
use App\Http\Controllers\Admin\PreferencesController;

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

Route::get('/', function () {
    return view('auth/login');
})->name('admin');
Route::name('auth.')->group(function () {
    Route::post('attempt', [UsersController::class, 'login'])->name('attempt');
    Route::get('change-password', function () {
        return view('pages/change-password');
    })->name('change-password');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [UsersController::class, 'logout'])->name('logout');
    Route::name('users.')->prefix('users')->group(function () {
        Route::get('list', [UsersController::class, 'usersList'])->name('list');
    });
    Route::name('ethnicities.')->prefix('ethnicities')->group(function () {
        Route::get('list', function () {
            return view('ethnicities/list');
        })->name('list');
        Route::get('add', function () {
            return view('ethnicities/add');
        })->name('add');
        Route::post('list', [EthnicitiesController::class, 'ethnicitiesList'])->name('list');
    });
    Route::name('preferences.')->prefix('preferences')->group(function () {
        Route::get('list', function () {
            return view('preferences/list');
        })->name('list');
        Route::get('add', function () {
            return view('preferences/add');
        })->name('add');
    });
});