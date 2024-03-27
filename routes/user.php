<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LogbookUserController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    // autentikasi user
    Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('auth.login');
    Route::post('/login', [AuthUserController::class, 'authenticate'])->name('auth.authenticate');

    // register atau mendaftar untuk user
    Route::get('/register', [RegisterUserController::class, 'create'])->name('auth.register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('auth.register');
});

Route::middleware(['auth'])->group(function () {
    // dashboard user
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

    // dashboard user logbook menu
    Route::get('/logbook', [LogbookUserController::class, 'create'])->name('user.logbook');
    Route::post('/logbook', [LogbookUserController::class, 'store'])->name('user.logbook');
    Route::delete('/logbook/{id}/delete', [LogbookUserController::class, 'destroy'])->name('delete.logbook');

    Route::get('/assignment-list', [AssignmentController::class, 'index'])->name('user.assignment');


    Route::get('/settings', [SettingUserController::class, 'index'])->name('user.settings');
    Route::get('/update-profile', [SettingUserController::class, 'create'])->name('user.profile');
    Route::post('/update-profile/{user}', [SettingUserController::class, 'update'])->name('user.update-profile');

    Route::get('/update-password', [UpdatePasswordController::class, 'create'])->name('user.password');
    Route::patch('/update-password', [UpdatePasswordController::class, 'update'])->name('user.update-password');

    // mengeluarkan user dari autentikasi
    Route::post('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
});
