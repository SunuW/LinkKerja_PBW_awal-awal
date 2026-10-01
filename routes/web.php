<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

// Route utama untuk halaman Login dan Register lewat AuthController
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// (Opsional) Kalau mau pakai link test yang lama juga boleh dibiarkan
Route::get('/test-login', function () {
    return view('auth.login');
});

Route::get('/test-register', function () {
    return view('auth.register');
});


Route::get('/', function () {
    return view('welcome');
});
