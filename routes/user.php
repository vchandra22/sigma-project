<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('auth.register');
});
