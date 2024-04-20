<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookCheckoutController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index'])->name('home');

Route::prefix('login')->group(function () {
    Route::view('/', 'pages.login')->name('login.form');
    Route::post('/', [AuthController::class, 'signIn'])->name('login');
});

Route::prefix('register')->group(function () {
    Route::view('/', 'pages.register')->name('register.form');
    Route::post('/', [AuthController::class, 'signUp'])->name('register');
});

Route::post('/logout', [AuthController::class, 'signOut'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::put('/update-profile', [AuthController::class, 'updateProfile'])->name('update.profile');

    Route::post('/checkout-book/{book}', [BookController::class, 'checkoutBook'])->name('checkout.book');

    Route::middleware(['isEmployee'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::resource('books', AdminBookController::class);
            Route::resource('authors', AuthorController::class);

            Route::get('/checkouts', [BookCheckoutController::class, 'index'])->name('checkouts.index');
            Route::put('/checkouts/extend-checkout/{bookCheckout}', [BookCheckoutController::class, 'extendCheckout'])->name('checkouts.extend');
            Route::put('/checkouts/return-checkout/{bookCheckout}', [BookCheckoutController::class, 'returnBook'])->name('checkouts.return');

            Route::get('/', function () {
                return view('admin.pages.index');
            })->name('admin.index');
        });

    });
});
