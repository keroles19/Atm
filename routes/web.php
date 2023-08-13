<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('show_login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// => Protected Routes

Route::middleware(['auth'])->name('atm.')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // ==> Account
    Route::prefix('account')->name('account.')->group(function () {
        Route::post('/create', [AccountController::class, 'store'])->name('store');
        Route::get('/{account}',    [AccountController::class, 'show'])->name('show');

        // Withdraw
        Route::post('/withdraw',    [AccountController::class, 'withdraw'])->name('withdraw');
    });


});

Route::fallback(function () {
    return view('errors.404');
});

