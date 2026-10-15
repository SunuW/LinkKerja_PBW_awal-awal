<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
 
Route::redirect('/', '/login');
 
// ---------- Auth (tamu) — UC-01 ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
 
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
 
// ---------- Sisi Perekrut (KF-01: profil perusahaan) ----------
Route::middleware(['auth', 'role:perekrut'])->prefix('perekrut')->name('perekrut.')->group(function () {
    Route::get('/profil', [ProfilController::class, 'perusahaan'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'updatePerusahaan'])->name('profil.update');
});
 
// ---------- Sisi Pencari Kerja (KF-01 s.d. KF-05) ----------
Route::middleware(['auth', 'role:pencari_kerja'])->prefix('pencari')->name('pencari.')->group(function () {
    Route::get('/beranda', [DashboardController::class, 'pencari'])->name('beranda');           // KF-04
 
    Route::get('/cari', [LowonganController::class, 'cari'])->name('cari');                     // KF-03
    Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('detail');
 
    Route::get('/profil', [ProfilController::class, 'pencariKerja'])->name('profil');           // KF-01
    Route::put('/profil', [ProfilController::class, 'updatePencariKerja'])->name('profil.update');
    Route::post('/profil/riwayat', [ProfilController::class, 'tambahRiwayat'])->name('profil.riwayat.store');
    Route::delete('/profil/riwayat/{riwayat}', [ProfilController::class, 'hapusRiwayat'])->name('profil.riwayat.destroy');
    Route::post('/profil/pengalaman', [ProfilController::class, 'tambahPengalaman'])->name('profil.pengalaman.store');
    Route::delete('/profil/pengalaman/{pengalaman}', [ProfilController::class, 'hapusPengalaman'])->name('profil.pengalaman.destroy');
    Route::post('/profil/dokumen', [ProfilController::class, 'unggahDokumen'])->name('profil.dokumen.store');   // KF-02
    Route::delete('/profil/dokumen/{dokumen}', [ProfilController::class, 'hapusDokumen'])->name('profil.dokumen.destroy');
});
