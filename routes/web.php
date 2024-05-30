<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ManageAnnouncementController;
use App\Http\Controllers\Admin\ManageCertificateController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Mentor\ManageAssignmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// download file pengumuman
Route::get('/download-announcement-file/{announcement}', [ManageAnnouncementController::class, 'downloadFile'])->name('downloadFileAnnouncement');
// download sertifikat
Route::get('/download-certificate/{certificate}', [ManageCertificateController::class, 'downloadCertificate'])->name('downloadFileCertificate');
//download file pertanyaan
Route::get('/download-assignment-pertanyaan/{assignment}', [ManageAssignmentController::class, 'downloadPertanyaan'])->name('downloadPertanyaan');
// download file jawaban
Route::get('/download-assignment-jawaban/{assignment}', [AssignmentController::class, 'downloadJawaban'])->name('downloadJawaban');
