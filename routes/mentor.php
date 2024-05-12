<?php

use App\Http\Controllers\AdminAuth\AuthAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\DashboardMentorController;
use App\Http\Controllers\Mentor\ManageAnnouncementController;
use App\Http\Controllers\Mentor\ManageAssignmentController;
use App\Http\Controllers\Mentor\ManageUserController;
use App\Http\Controllers\Mentor\SettingMentorController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Mentor\ManageCertificateController;
use App\Http\Controllers\Mentor\ManageLogbookController;
use App\Http\Controllers\Mentor\UpdatePasswordMentorController;

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
    Route::get('/manage-user/edit/{document}', [ManageUserController::class, 'edit'])->name('mentor.editUser');
    Route::put('/manage-user/{document}/update', [ManageUserController::class, 'update'])->name('mentor.updatePeserta');
    Route::get('/download-documents-file/{documents}', [ManageUserController::class, 'downloadFile'])->name('mentor.downloadDocuments');

    //manage logbook
    Route::get('/manage-logbook', [ManageLogbookController::class, 'index'])->name('mentor.manageLogbook');
    Route::get('/print-logbook/{id}', [ManageLogbookController::class, 'show'])->name('mentor.showLogbook');

    //manage assignment
    Route::get('/manage-assignment', [ManageAssignmentController::class, 'index'])->name('mentor.manageAssignment');
    Route::get('/create-assignment', [ManageAssignmentController::class, 'create'])->name('mentor.createAssignment');
    Route::post('/store-assignment', [ManageAssignmentController::class, 'store'])->name('mentor.storeAssignment');
    Route::get('/detail-assignment/{assignment}', [ManageAssignmentController::class, 'show'])->name('mentor.detailAssignment');
    Route::get('/edit-assignment/{assignment}', [ManageAssignmentController::class, 'edit'])->name('mentor.editAssignment');
    Route::put('/update-assignment/{assignment}', [ManageAssignmentController::class, 'update'])->name('mentor.updateAssignment');
    Route::delete('/delete-assignment/{id}', [ManageAssignmentController::class, 'destroy'])->name('mentor.deleteAssignment');

    // settings admin
    Route::get('/settings', [SettingMentorController::class, 'index'])->name('mentor.settings');
    Route::get('/settings/edit/{id}', [SettingMentorController::class, 'edit'])->name('mentor.editProfile');
    Route::put('/settings/update/{admin}', [SettingMentorController::class, 'update'])->name('mentor.updateProfile');

    // ganti password admin
    Route::get('/update-password', [UpdatePasswordMentorController::class, 'edit'])->name('mentor.editPassword');
    Route::patch('update-password', [UpdatePasswordMentorController::class, 'update'])->name('mentor.updatePassword');

    // manage sertifikat & penilaian
    Route::get('manage-score', [ManageCertificateController::class, 'index'])->name('mentor.managePenilaian');
    Route::get('create-score', [ManageCertificateController::class, 'create'])->name('mentor.createPenilaian');
    Route::post('store-score', [ManageCertificateController::class, 'store'])->name('mentor.storePenilaian');
    Route::get('add-new-score/{certificate}', [ManageCertificateController::class, 'add'])->name('mentor.addPenilaian');
    Route::get('detail-score/{certificate}', [ManageCertificateController::class, 'show'])->name('mentor.detailPenilaian');
    Route::get('edit-score/{score}', [ManageCertificateController::class, 'edit'])->name('mentor.editPenilaian');
    Route::put('update-score/{score}', [ManageCertificateController::class, 'update'])->name('mentor.updatePenilaian');
    Route::delete('/delete-score/{id}', [ManageCertificateController::class, 'destroy'])->name('mentor.deletePenilaian');
});
