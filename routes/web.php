<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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