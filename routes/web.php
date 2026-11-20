<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;

// Login & logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Semua route di bawah ini wajib login (guest diarahkan ke halaman login)
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('pemesanan.index');
    });

    // Admin & Petugas: lihat, tambah, ubah
    Route::middleware('role:admin,petugas')->group(function () {
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
        Route::get('/pemesanan/{pemesanan}/edit', [PemesananController::class, 'edit'])->name('pemesanan.edit');
        Route::put('/pemesanan/{pemesanan}', [PemesananController::class, 'update'])->name('pemesanan.update');
    });

    // Hanya Admin: hapus
    Route::delete('/pemesanan/{pemesanan}', [PemesananController::class, 'destroy'])
        ->middleware('role:admin')
        ->name('pemesanan.destroy');
});