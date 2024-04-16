<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\PageController::class, 'index'])->name('home');

Route::prefix('login')->group(function () {
    Route::view('/', 'pages.login')->name('login.form');
    Route::post('/', [AuthController::class, 'signIn'])->name('login');
});

Route::prefix('register')->group(function () {
    Route::view('/', 'pages.register')->name('register.form');
    Route::post('/', [AuthController::class, 'signUp'])->name('register');
});

Route::post('/logout', function () {
    Auth::logout();

    return to_route('login.form');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::view('dashboard', 'pages.dashboard')->name('dashboard');
    Route::put('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');

    Route::middleware(['isEmployee'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('books', BookController::class);
            Route::resource('authors', AuthorController::class);

            Route::get('/', function () {
                return view('admin.pages.index');
            });
        });
    });
});
