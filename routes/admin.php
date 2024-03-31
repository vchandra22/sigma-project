<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ManageContentController;
use App\Http\Controllers\Admin\ManageHomepageController;
use App\Http\Controllers\Admin\ManageOfficeController;
use App\Http\Controllers\Admin\ManagePositionController;
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

    // manage content
    Route::get('/manage-content', [ManageContentController::class, 'index'])->name('admin.manageContent');

    // homepage content
    Route::get('/manage-homepage-content/{id}', [ManageHomepageController::class, 'edit'])->name('admin.manageHomepage');
    Route::put('/manage-homepage-content/update/{homepage}', [ManageHomepageController::class, 'update'])->name('admin.updateHomepage');

    // internship roles content
    Route::get('/manage-internship-roles', [ManagePositionController::class, 'index'])->name('admin.managePosition');
    Route::get('/manage-internship-roles/add-new-role', [ManagePositionController::class, 'create'])->name('admin.createPosition');
    Route::post('/manage-internship-roles/add-new-role', [ManagePositionController::class, 'store'])->name('admin.storePosition');
    Route::get('/manage-internship-roles/edit/{slug}', [ManagePositionController::class, 'edit'])->name('admin.editPosition');
    Route::put('/manage-internship-roles/update/{position}', [ManagePositionController::class, 'update'])->name('admin.updatePosition');
    Route::delete('/manage-internhip-roles/{id}/delete', [ManagePositionController::class, 'destroy'])->name('admin.deletePosition');

    // instansi magang
    Route::get('/manage-instansi-magang', [ManageOfficeController::class, 'index'])->name('admin.manageOffice');
    Route::get('/manage-instansi-magang/add-new-office', [ManageOfficeController::class, 'create'])->name('admin.createOffice');
    Route::post('/manage-instansi-magang/add-new-office', [ManageOfficeController::class, 'store'])->name('admin.storeOffice');
    Route::get('/manage-instansi-magang/edit/{slug}', [ManageOfficeController::class, 'edit'])->name('admin.editOffice');
    Route::put('/manage-instansi-magang/update/{office}', [ManageOfficeController::class, 'update'])->name('admin.updateOffice');
    Route::delete('manage-instansi-magang/delete/{id}', [ManageOfficeController::class, 'destroy'])->name('admin.deleteOffice');
});
