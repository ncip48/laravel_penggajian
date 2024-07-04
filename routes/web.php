<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanAbsen;
use App\Http\Controllers\LaporanGaji;
use App\Http\Controllers\LaporanSlipGaji;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\PotongGajiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth', 'web'])->group(function () {
    //dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //karyawan
    Route::resource('karyawan', KaryawanController::class);

    //jabatan
    Route::resource('jabatan', JabatanController::class);

    //absensi
    Route::resource('absensi', AbsensiController::class);

    //lembur
    Route::resource('lembur', LemburController::class);

    //setting potong gaji
    Route::resource('setting-potong-gaji', PotongGajiController::class);

    //gaji
    Route::resource('gaji', GajiController::class);
    Route::put('gaji/{gaji}/approve', [GajiController::class, 'approve'])->name('gaji.approve');
    Route::put('gaji/{gaji}/decline', [GajiController::class, 'decline'])->name('gaji.decline');

    //laporan
    Route::get('laporan-gaji', [LaporanGaji::class, 'index'])->name('laporan.gaji');
    Route::post('laporan-gaji', [LaporanGaji::class, 'print'])->name('laporan.gaji.print');
    Route::get('laporan-absen', [LaporanAbsen::class, 'index'])->name('laporan.absen');
    Route::post('laporan-absen', [LaporanAbsen::class, 'print'])->name('laporan.absen.print');
    Route::get('slip-gaji', [LaporanSlipGaji::class, 'index'])->name('slip.gaji');
    Route::post('slip-gaji', [LaporanSlipGaji::class, 'print'])->name('slip.gaji.print');

    //ubah password
    Route::get('profile', [ProfileController::class, 'index'])->name('ubah-profile');
    Route::put('ubah-profile', [ProfileController::class, 'ubah_profile'])->name('profile.update');
    Route::put('ubah-avatar', [ProfileController::class, 'action'])->name('avatar.update');
    Route::put('ubah-password', [ProfileController::class, 'ubah_password'])->name('password.update');
});
