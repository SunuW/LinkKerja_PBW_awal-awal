<?php

use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Cek status API
Route::get('/status', function () {
    return response()->json([
        'status' => 'ok',
        'aplikasi' => 'LinkKerja API',
    ]);
});

// Login API (mengembalikan token Sanctum)
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Kredensial tidak valid.'], 401);
    }

    $token = $user->createToken('praktikum-token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $user->only(['id', 'name', 'email', 'role']),
    ]);
});

// Daftar & Detail Lowongan (Publik)
Route::get('/lowongan', function (Request $request) {
    $data = Lowongan::where('status', 'aktif')
        ->filter($request->only('kata_kunci', 'bidang'))
        ->with('perusahaan:id_perusahaan,nama_perusahaan,lokasi')
        ->latest()
        ->get();

    return response()->json($data);
});

Route::get('/lowongan/{lowongan}', function (Lowongan $lowongan) {
    return response()->json($lowongan->load('perusahaan'));
});

// Profil User Terautentikasi (Sanctum)
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return response()->json($request->user());
});