<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\ProfilPencariKerja;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Uji Admin (Perekrut)
        $admin = User::firstOrCreate(
            ['email' => 'admin@linkkerja.test'],
            [
                'name' => 'Admin Pengelola LinkKerja',
                'password' => Hash::make('password123'),
                'role' => 'perekrut',
            ]
        );

        $perusahaan = Perusahaan::firstOrCreate(
            ['id_user' => $admin->id],
            [
                'nama_perusahaan' => 'PT Uji Keamanan Madiun',
                'bidang' => 'Teknologi Informasi',
                'lokasi' => 'Madiun, Jawa Timur',
                'deskripsi' => 'Akun perusahaan dummy untuk pengujian praktikum.',
            ]
        );

        Lowongan::firstOrCreate(
            [
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'judul_posisi' => 'Security Tester Intern',
            ],
            [
                'bidang' => 'Teknologi Informasi',
                'lokasi' => 'Madiun',
                'tipe_kerja' => 'magang',
                'deskripsi' => 'Lowongan dummy untuk pengujian fitur CRUD dan lamaran.',
                'kriteria' => 'Memahami dasar pengujian keamanan aplikasi web.',
                'status' => 'aktif',
            ]
        );

        // 2. Akun Uji User (Pencari Kerja)
        $user = User::firstOrCreate(
            ['email' => 'user@linkkerja.test'],
            [
                'name' => 'User Pelamar Dummy',
                'password' => Hash::make('password123'),
                'role' => 'pencari_kerja',
            ]
        );

        ProfilPencariKerja::firstOrCreate(
            ['id_user' => $user->id],
            [
                'alamat' => 'Madiun, Jawa Timur',
                'no_telepon' => '081200000000',
                'ringkasan' => 'Akun pencari kerja dummy untuk pengujian praktikum.',
            ]
        );
    }
}