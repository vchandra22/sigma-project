<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\AuthAdminController;

Route::middleware(['guest', 'redirect.auth'])->group(function () {
    // login admin
    Route::get('/login', [AuthAdminController::class, 'create'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'store'])->name('admin.authenticate');
});

Route::middleware(['auth:admin'])->group(function () {
    //logout admin
    Route::post('/logout', [AuthAdminController::class, 'destroy'])->name('admin.logout');
});

Route::middleware(['auth:admin', 'role:admin'])->group(function () {
    // dashboard admin
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
});
