<?php

use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfilAkunController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranPublikController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

// Storage route
Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file, 200)->header('Content-Type', $type);
})->where('folder', '.*')->where('filename', '.*');

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/guru', [GuruController::class, 'index'])->name('guru');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
Route::get('/pendaftaran', [PendaftaranPublikController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [PendaftaranPublikController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran/sukses', [PendaftaranPublikController::class, 'sukses'])->name('pendaftaran.sukses');

// Download Aplikasi
Route::get('/download-aplikasi', [AplikasiController::class, 'index'])->name('aplikasi');
Route::get('/download-aplikasi/{id}', [AplikasiController::class, 'download'])->name('aplikasi.download');

// Auth Publik (Orang Tua)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Lupa Password (OTP)
    Route::get('/forgot-password',         [ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/forgot-password',        [ForgotPasswordController::class, 'sendOtp'])->name('password.email');
    Route::get('/verify-otp',              [ForgotPasswordController::class, 'showVerify'])->name('password.verify.form');
    Route::post('/verify-otp',             [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify');
    Route::post('/resend-otp',             [ForgotPasswordController::class, 'resendOtp'])->name('password.resend');
    Route::get('/reset-password',          [ForgotPasswordController::class, 'showReset'])->name('password.reset.form');
    Route::post('/reset-password',         [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Riwayat Pendaftaran
    Route::get('/pendaftaran/riwayat', [PendaftaranPublikController::class, 'riwayat'])->name('pendaftaran.riwayat');
    Route::get('/pendaftaran/riwayat/{id}', [PendaftaranPublikController::class, 'detail'])->name('pendaftaran.detail');

    // Profil Akun
    Route::get('/profil-akun', [ProfilAkunController::class, 'index'])->name('profil-akun');
    Route::patch('/profil-akun/info', [ProfilAkunController::class, 'updateInfo'])->name('profil-akun.update-info');
    Route::patch('/profil-akun/password', [ProfilAkunController::class, 'updatePassword'])->name('profil-akun.update-password');
});
