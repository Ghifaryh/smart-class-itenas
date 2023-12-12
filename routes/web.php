<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\VerifAkunController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing-page.page');
});

Route::prefix('scr')->name('scr.')->group(
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
        Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


        Route::group(['middleware' => ['auth', 'ceklevel:dosen,admin']], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/pemesanan/admin/list', [PemesananController::class, 'adminList'])->name('listadmin');
            Route::get('/pemesanan/dosen/list', [PemesananController::class, 'dosenList'])->name('listdosen');
            Route::get('/get-matkul/{semester}/{prodi}', [DashboardController::class, 'getMatkul']);
            Route::get('/dosen-matkul/{semester}/{prodi}/{kode_matkul}/{kelas}', [DashboardController::class, 'getDosenMatkul']);
            // Route::post('/dashboard', [PemesananController::class, 'daftar']);
            Route::post('/dashboard', [PemesananController::class, 'ajaxRequestPost']);
            Route::post('/dashboard/hapusketpemesanan/{id}', [PemesananController::class, 'hapusket']);
            Route::post('/dashboard/edit/{id}', [PemesananController::class, 'edit']);
            Route::post('/dashboard/update/{id}', [PemesananController::class, 'update']);
            Route::get('/dashboard/bukti/{id}', [PemesananController::class, 'bukti']);
        });

        Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
            Route::post('/dashboard/terima/{id}', [PemesananController::class, 'accept']);
            Route::post('/dashboard/batal/{id}/{pesan}', [PemesananController::class, 'cancel']);
            Route::post('/dashboard/batalhapus/{id}/{pesan}', [PemesananController::class, 'cancelhapus']);
            Route::post('/dashboard/bataledit/{id}', [PemesananController::class, 'cancelhapus']);
            Route::get('/jadwal/list', [JadwalController::class, 'list'])->name('jadwallist');
            Route::delete('/dashboard/hapusjadwal/{id}', [JadwalController::class, 'destroy']);
            Route::delete('/dashboard/hapuspemesanan/{id}', [PemesananController::class, 'destroy']);
            Route::get('/truangan', [RuanganController::class, 'index'])->name('truangan');
            Route::get('/truangan/list', [RuanganController::class, 'list'])->name('truangan.list');
            // Route::post('/truangan', [RuanganController::class, 'tambah']);
            Route::post('/truangan', [RuanganController::class, 'ajaxRequestRuangan']);
            Route::get('/truangan/{id}', [RuanganController::class, 'edit']);
            Route::post('/truangan/update/{id}', [RuanganController::class, 'update']);
            Route::delete('/truangan/{id}', [RuanganController::class, 'destroy']);
            Route::get('/verifakun', [VerifAkunController::class, 'index'])->name('verifakun');
            Route::post('/verifakun/verifikasi/{kode}', [VerifAkunController::class, 'verifikasi']);
            Route::post('/verifakun/tolak/{kode}', [VerifAkunController::class, 'cancel']);
            Route::delete('/verifakun/hapus/{kode}', [VerifAkunController::class, 'destroy']);
            Route::get('/pengaturan', [HomeController::class, 'pengaturan'])->name('pengaturan');
            Route::get('/pengaturan/imagelist', [HomeController::class, 'listGambar'])->name('image.list');
            Route::post('/pengaturan/update/{id}', [HomeController::class, 'update']);
            Route::post('/pengaturan/image', [HomeController::class, 'addImage']);
            Route::delete('/pengaturan/image/{id}', [HomeController::class, 'destroy']);
        });
    }

);

// Route::get('/register', [RegisterController::class, 'index']);
// Route::post('/register', [RegisterController::class, 'store']);






include __DIR__ . '/lab/web.php';
