<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\AuthAdminController;

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/login', [AuthAdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'authenticate'])->name('admin.authenticate');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
});
