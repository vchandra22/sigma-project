<?php

use App\Http\Controllers\Frontend\MainIndexController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::get('/', [MainIndexController::class, 'index'])->name('main.index');
    Route::get('/posisi-pekerjaan', [MainIndexController::class, 'roleList'])->name('frontend.roleList');
    Route::get('/posisi-pekerjaan/{slug}', [MainIndexController::class, 'roleDetail'])->name('frontend.roleDetail');
    Route::get('/publikasi', [MainIndexController::class, 'publikasiList'])->name('frontend.publikasiList');
    Route::get('/publikasi/{slug}', [MainIndexController::class, 'publikasiDetail'])->name('frontend.publikasiDetail');
    Route::get('/faq', [MainIndexController::class, 'faq'])->name('frontend.faq');
});
