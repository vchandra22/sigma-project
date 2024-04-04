<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LogbookUserController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest', 'redirect.auth'])->group(function () {
    // autentikasi user
    Route::get('/login', [AuthUserController::class, 'create'])->name('auth.login');
    Route::post('/login', [AuthUserController::class, 'store'])->name('auth.authenticate');

    // register user
    Route::get('/register', [RegisterUserController::class, 'create'])->name('auth.register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('auth.register');
});

Route::middleware(['auth:web'])->group(function () {
    // dashboard user
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');

    // logbook user
    Route::get('/logbook', [LogbookUserController::class, 'create'])->name('user.logbook');
    Route::post('/logbook', [LogbookUserController::class, 'store'])->name('user.logbook');
    Route::delete('/logbook/{id}/delete', [LogbookUserController::class, 'destroy'])->name('delete.logbook');

    // assignment user
    Route::get('/assignment-list', [AssignmentController::class, 'index'])->name('user.assignment');

    // pengaturan user
    Route::get('/settings', [SettingUserController::class, 'index'])->name('user.settings');
    Route::get('/update-profile/edit/{user}', [SettingUserController::class, 'edit'])->name('user.profile');
    Route::post('/update-profile/{user}', [SettingUserController::class, 'update'])->name('user.update-profile');

    // ganti password user
    Route::get('/update-password', [UpdatePasswordController::class, 'edit'])->name('user.editPassword');
    Route::patch('/update-password', [UpdatePasswordController::class, 'update'])->name('user.updatePassword');

    // mengeluarkan user dari autentikasi
    Route::post('/logout', [AuthUserController::class, 'destroy'])->name('user.logout');
});
