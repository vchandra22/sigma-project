<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\AuthUserController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LogbookUserController;
use App\Http\Controllers\Mentor\ManageLaporanController;
use App\Http\Controllers\SettingUserController;
use App\Http\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest', 'redirect.auth'])->group(function () {
    // autentikasi user
    Route::get('/login', [AuthUserController::class, 'create'])->name('auth.login');
    Route::post('/login', [AuthUserController::class, 'store'])->name('auth.authenticate');

    // register user
    Route::get('/register', [RegisterUserController::class, 'create'])->name('auth.register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('auth.storeRegister');
});

Route::middleware(['auth:web'])->group(function () {
    // dashboard user
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
    Route::put('/store-laporan', [DashboardUserController::class, 'update'])->name('user.storeLaporan');


    // logbook user
    Route::get('/logbook', [LogbookUserController::class, 'create'])->name('user.logbook');
    Route::post('/logbook', [LogbookUserController::class, 'store'])->name('user.storeLogbook');
    Route::get('/print-logbook/{id}', [LogbookUserController::class, 'show'])->name('user.showLogbook');
    Route::delete('/logbook/{id}/delete', [LogbookUserController::class, 'destroy'])->name('delete.logbook');

    // assignment user
    Route::get('/assignment-list', [AssignmentController::class, 'index'])->name('user.assignment');
    Route::get('/assignment-list/belum-dikerjakan', [AssignmentController::class, 'statusBelumDikerjakan'])->name('user.assignmentBelumDikerjakan');
    Route::get('/assignment-list/selesai', [AssignmentController::class, 'statusSelesai'])->name('user.assignmentstatusSelesai');
    Route::get('/assignment-list/terlambat', [AssignmentController::class, 'statusTerlambat'])->name('user.assignmentstatusTerlambat');
    Route::get('/assignment-detail/{assignment}', [AssignmentController::class, 'edit'])->name('user.editAssignment');
    Route::put('/assignment-update/{assignment}', [AssignmentController::class, 'update'])->name('user.updateAssignment');
    Route::put('assignments/{assignment}', [AssignmentController::class, 'cancelJawaban'])->name('user.cancelAssignment');

    // pengaturan user
    Route::get('/settings', [SettingUserController::class, 'index'])->name('user.settings');
    Route::get('/update-profile/edit/{user}', [SettingUserController::class, 'edit'])->name('user.profile');
    Route::post('/update-profile/{user}', [SettingUserController::class, 'update'])->name('user.update-profile');

    // ganti password user
    Route::get('/update-password', [UpdatePasswordController::class, 'edit'])->name('user.editPassword');
    Route::patch('/update-password', [UpdatePasswordController::class, 'update'])->name('user.updatePassword');

    // mengeluarkan user dari autentikasi
    Route::post('/logout', [AuthUserController::class, 'destroy'])->name('user.logout');

    //download file
    Route::get('/download-documents-file/{documents}', [DashboardUserController::class, 'downloadFile'])->name('user.downloadDocuments');
    Route::get('download-laporan/{laporan}', [ManageLaporanController::class, 'downloadLaporan'])->name('user.downloadLaporan');

});
