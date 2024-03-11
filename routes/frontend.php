<?php

use App\Http\Controllers\Frontend\MainIndexController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [MainIndexController::class, 'index'])->name('main.index');
    Route::get('/internship-role', [MainIndexController::class, 'roleList'])->name('frontend.roleList');
    Route::get('/internship-role/developer', [MainIndexController::class, 'roleDetail'])->name('frontend.roleDetail');
    Route::get('/publikasi', [MainIndexController::class, 'publikasiList'])->name('frontend.publikasiList');
    Route::get('/publikasi/judul-publikasi', [MainIndexController::class, 'publikasiDetail'])->name('frontend.publikasiDetail');
    Route::get('/faq', [MainIndexController::class, 'faq'])->name('frontend.faq');
});
