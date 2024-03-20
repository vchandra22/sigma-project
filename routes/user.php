<?php

use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    // login route
    Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthUserController::class, 'authenticate'])->name('auth.authenticate');

    // register route
    Route::get('/register', [RegisterUserController::class, 'index'])->name('auth.register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('auth.register');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [AuthUserController::class, 'showDashboard'])->name('user.dashboard');
    Route::get('/logbook', [AuthUserController::class, 'showLogbook'])->name('user.logbook');
    Route::post('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
});
