<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ManageAnnouncementController;
use App\Http\Controllers\Admin\ManageContentController;
use App\Http\Controllers\Admin\ManageFaqController;
use App\Http\Controllers\Admin\ManageHomepageController;
use App\Http\Controllers\Admin\ManageOfficeController;
use App\Http\Controllers\Admin\ManagePositionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuth\AuthAdminController;
use App\Http\Controllers\ManagePublicationController;

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

    // manage pengumuman content
    Route::get('/announcement/edit/{id}', [ManageAnnouncementController::class, 'edit'])->name('admin.editAnnouncement');
    Route::put('/announcement/update/{announcement}', [ManageAnnouncementController::class, 'update'])->name('admin.updateAnnouncement');

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

    // faq content
    Route::get('/manage-faq-content', [ManageFaqController::class, 'index'])->name('admin.manageFaq');
    Route::get('/manage-faq-content/add-new-faq', [ManageFaqController::class, 'create'])->name('admin.createFaq');
    Route::post('/manage-faq-content/add-new-faq', [ManageFaqController::class, 'store'])->name('admin.storeFaq');
    Route::get('/manage-faq-content/edit/{slug}', [ManageFaqController::class, 'edit'])->name('admin.editFaq');
    Route::put('/manage-faq-content/update/{faq}', [ManageFaqController::class, 'update'])->name('admin.updateFaq');
    Route::delete('/manage-faq-content/delete/{id}', [ManageFaqController::class, 'destroy'])->name('admin.deleteFaq');

    // publication content
    Route::get('/manage-publication-content', [ManagePublicationController::class, 'index'])->name('admin.managePublication');
    Route::get('/manage-publication-content/add-new-publication', [ManagePublicationController::class, 'create'])->name('admin.createPublication');
    Route::post('/manage-publication-content/add-new-publication', [ManagePublicationController::class, 'store'])->name('admin.storePublication');
    Route::get('/manage-publication-content/edit/{slug}', [ManagePublicationController::class, 'edit'])->name('admin.editPublication');
    Route::put('/manage-publication-content/update/{publication}', [ManagePublicationController::class, 'update'])->name('admin.updatePublication');
    Route::delete('/manage-publication-content/delete/{id}', [ManagePublicationController::class, 'destroy'])->name('admin.deletePublication');

});
