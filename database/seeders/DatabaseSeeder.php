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
        // Akun perekrut contoh
        $perekrut = User::create([
            'name' => 'Nabil Sunu Widyadhana',
            'email' => 'nabil@contoh.com',
            'password' => Hash::make('password'),
            'role' => 'perekrut',
        ]);
 
        $perusahaan = Perusahaan::create([
            'id_user' => $perekrut->id,
            'nama_perusahaan' => 'PT Teknologi Madiun',
            'bidang' => 'Teknologi Informasi',
            'lokasi' => 'Madiun, Jawa Timur',
            'deskripsi' => 'Perusahaan pengembang perangkat lunak.',
        ]);
 
        Lowongan::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'judul_posisi' => 'Frontend Developer',
            'bidang' => 'Teknologi Informasi',
            'lokasi' => 'Madiun',
            'tipe_kerja' => 'full_time',
            'deskripsi' => 'Membangun antarmuka aplikasi web menggunakan Laravel Blade, HTML, dan CSS.',
            'kriteria' => 'Menguasai HTML/CSS, memahami dasar Laravel Blade.',
            'status' => 'aktif',
        ]);
 
        // Akun pencari kerja contoh
        $pencariKerja = User::create([
            'name' => 'Lathifah Widya Zahra',
            'email' => 'zahra@contoh.com',
            'password' => Hash::make('password'),
            'role' => 'pencari_kerja',
        ]);
 
        ProfilPencariKerja::create([
            'id_user' => $pencariKerja->id,
            'alamat' => 'Madiun, Jawa Timur',
            'no_telepon' => '081234567890',
            'ringkasan' => 'Mahasiswa TRPL yang tertarik pada pengembangan web.',
        ]);
    }
}
