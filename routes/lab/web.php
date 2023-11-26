<?php

use App\Http\Controllers\Lab\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('lab')->name('lab.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::group(['middleware' => ['auth', 'ceklevel:dosen,admin']], function () {
    });
    // Route::get('/pemesanan', [HomeController::class, 'pemesanan'])->name('lab.pemesanan');
    // Route::get('/daftarruangan', [HomeController::class, 'daftarruangan'])->name('lab.daftarruangan');
    // tambahkan rute-rute lainnya sesuai kebutuhan
});
