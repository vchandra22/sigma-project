<?php

use App\Http\Controllers\AdminAuth\AuthAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\DashboardMentorController;
use App\Http\Controllers\Mentor\ManageAnnouncementController;
use App\Http\Controllers\Mentor\ManageAssignmentController;
use App\Http\Controllers\Mentor\ManageUserController;

Route::middleware(['guest:admin'])->group(function () {
    //
});

Route::middleware(['auth:admin', 'role:mentor'])->group(function () {
    // dashboard mentor
    Route::get('/dashboard', [DashboardMentorController::class, 'index'])->name('mentor.dashboard');

    // announcement
    Route::get('/announcement/edit/{announcement}', [ManageAnnouncementController::class, 'edit'])->name('mentor.editAnnouncement');
    Route::put('/announcement/update/{announcement}', [ManageAnnouncementController::class, 'update'])->name('mentor.updateAnnouncement');

    //manage user
    Route::get('/manage-user', [ManageUserController::class, 'index'])->name('mentor.manageUser');
    Route::get('/table-manage-user', [ManageUserController::class, 'tableUser'])->name('mentor.tableUser');
    Route::get('/manage-user/add-new-user', [ManageUserController::class, 'create'])->name('mentor.createUser');
    Route::post('/manage-user/add-new-user', [ManageUserController::class, 'store'])->name('mentor.storeUser');
    Route::get('/manage-user/edit/{document}', [ManageUserController::class, 'edit'])->name('mentor.editUser');
    Route::put('/manage-user/{document}/update', [ManageUserController::class, 'update'])->name('mentor.updatePeserta');

    //manage assignment
    Route::get('manage-assignment', [ManageAssignmentController::class, 'index'])->name('mentor.manageAssignment');
    Route::get('create-assignment', [ManageAssignmentController::class, 'create'])->name('mentor.createAssignment');
    Route::post('store-assignment', [ManageAssignmentController::class, 'store'])->name('mentor.storeAssignment');

});
