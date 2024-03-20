<?php

use App\Http\Controllers\Auth\AuthUserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    // login route
    Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthUserController::class, 'authenticate'])->name('auth.authenticate');

    // register route
    Route::get('/register', [AuthUserController::class, 'showRegisterForm'])->name('auth.register');

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [AuthUserController::class, 'showDashboard'])->name('user.dashboard');
    Route::get('/logbook', [AuthUserController::class, 'showLogbook'])->name('user.logbook');
    Route::post('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
});
