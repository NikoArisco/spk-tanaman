<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\TanamanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Rute Autentikasi
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'loginProcess']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'registerProcess']);
// Rute untuk logout (Mendukung POST & GET untuk keamanan dan kenyamanan navigasi UI)
Route::match(['get', 'post'], 'logout', [AuthController::class, 'logout'])->name('logout');

// Grup untuk semua halaman Admin
Route::middleware(['auth', 'admin:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('tanaman', TanamanController::class);
    Route::resource('users', UserController::class);
});

// Rute untuk pengguna terautentikasi (Admin & Petani)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    Route::post('/perhitungan', [PerhitunganController::class, 'hitung'])->name('perhitungan.hitung');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat/{id}', [RiwayatController::class, 'show'])->name('riwayat.show');

    // Rute Profil Saya
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute Export PDF & Excel
    Route::post('/export/hasil-pdf', [ExportController::class, 'exportHasilPdf'])->name('export.hasil.pdf');
    Route::get('/export/riwayat-pdf', [ExportController::class, 'exportRiwayatPdf'])->name('export.riwayat.pdf');
    Route::get('/export/riwayat-excel', [ExportController::class, 'exportRiwayatExcel'])->name('export.riwayat.excel');
});
