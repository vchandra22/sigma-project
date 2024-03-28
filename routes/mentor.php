<?php

use App\Http\Controllers\AdminAuth\AuthAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\DashboardMentorController;

Route::middleware(['guest:admin'])->group(function () {
    //
});

Route::middleware(['auth:admin', 'role:mentor'])->group(function () {
    // dashboard mentor
    Route::get('/dashboard', [DashboardMentorController::class, 'index'])->name('mentor.dashboard');
});
