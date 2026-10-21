<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
 
Route::redirect('/', '/login');
 
// ---------- Auth (tamu) ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
 
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
 
// ---------- Sisi Perekrut ----------
Route::middleware(['auth', 'role:perekrut'])->prefix('perekrut')->name('perekrut.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'perekrut'])->name('dashboard');
 
    Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/buat', [LowonganController::class, 'create'])->name('lowongan.create');
    Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
    Route::get('/lowongan/{lowongan}/edit', [LowonganController::class, 'edit'])->name('lowongan.edit');
    Route::put('/lowongan/{lowongan}', [LowonganController::class, 'update'])->name('lowongan.update');
    Route::patch('/lowongan/{lowongan}/toggle-status', [LowonganController::class, 'toggleStatus'])->name('lowongan.toggleStatus');
    Route::delete('/lowongan/{lowongan}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
 
    Route::get('/kandidat', [LamaranController::class, 'kandidat'])->name('kandidat.index');
    Route::patch('/kandidat/{lamaran}/status', [LamaranController::class, 'updateStatus'])->name('kandidat.updateStatus');
 
    Route::get('/profil', [ProfilController::class, 'perusahaan'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'updatePerusahaan'])->name('profil.update');
});
 
// ---------- Sisi Pencari Kerja ----------
Route::middleware(['auth', 'role:pencari_kerja'])->prefix('pencari')->name('pencari.')->group(function () {
    Route::get('/beranda', [DashboardController::class, 'pencari'])->name('beranda');
 
    Route::get('/cari', [LowonganController::class, 'cari'])->name('cari');
    Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('detail');
    Route::post('/lowongan/{lowongan}/lamar', [LamaranController::class, 'store'])->name('lamar');
 
    Route::get('/lamaran-saya', [LamaranController::class, 'index'])->name('lamaran.index');
 
    Route::get('/profil', [ProfilController::class, 'pencariKerja'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'updatePencariKerja'])->name('profil.update');
    Route::post('/profil/riwayat', [ProfilController::class, 'tambahRiwayat'])->name('profil.riwayat.store');
    Route::delete('/profil/riwayat/{riwayat}', [ProfilController::class, 'hapusRiwayat'])->name('profil.riwayat.destroy');
    Route::post('/profil/dokumen', [ProfilController::class, 'unggahDokumen'])->name('profil.dokumen.store');
});
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return redirect('/login');
});

// Route utama untuk halaman Login dan Register lewat AuthController
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Route untuk Perekrut lewat PageController
Route::get('/perekrut/dashboard', [PageController::class, 'dashboardPerekrut'])->name('perekrut.dashboard');
Route::get('/perekrut/lowongan/create', [PageController::class, 'createLowongan'])->name('perekrut.lowongan.create');
