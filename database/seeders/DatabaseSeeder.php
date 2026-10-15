<?php
 
namespace Database\Seeders;
 
use App\Models\Lowongan;
use App\Models\Perusahaan;
use App\Models\ProfilPencariKerja;
use App\Models\RiwayatPencarian;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Dua perekrut dengan perusahaannya ----
        $perekrut1 = User::create([
            'name' => 'Nabil Sunu Widyadhana', 'email' => 'nabil@contoh.com',
            'password' => Hash::make('password'), 'role' => 'perekrut',
        ]);
        $perusahaan1 = Perusahaan::create([
            'id_user' => $perekrut1->id, 'nama_perusahaan' => 'PT Teknologi Madiun',
            'bidang' => 'Teknologi Informasi', 'lokasi' => 'Madiun, Jawa Timur',
            'deskripsi' => 'Perusahaan pengembang perangkat lunak.',
        ]);
 
        $perekrut2 = User::create([
            'name' => 'HRD Maju Bersama', 'email' => 'hrd@contoh.com',
            'password' => Hash::make('password'), 'role' => 'perekrut',
        ]);
        $perusahaan2 = Perusahaan::create([
            'id_user' => $perekrut2->id, 'nama_perusahaan' => 'CV Maju Bersama',
            'bidang' => 'Pemasaran', 'lokasi' => 'Surabaya, Jawa Timur',
            'deskripsi' => 'Agensi pemasaran dan desain kreatif.',
        ]);
 
        // ---- Lowongan contoh (bahan untuk pencarian & rekomendasi) ----
        $daftar = [
            [$perusahaan1, 'Frontend Developer', 'Teknologi Informasi', 'Madiun', 'full_time', 'Membangun antarmuka web dengan Laravel Blade, HTML, dan CSS.', 'Menguasai HTML/CSS, memahami dasar Laravel.'],
            [$perusahaan1, 'Backend Developer', 'Teknologi Informasi', 'Surabaya', 'full_time', 'Membangun API dan basis data aplikasi menggunakan Laravel.', 'Memahami PHP, MySQL, dan Eloquent ORM.'],
            [$perusahaan2, 'UI/UX Designer', 'Desain', 'Remote', 'kontrak', 'Merancang wireframe dan prototipe produk digital.', 'Menguasai Figma dan prinsip desain berpusat pada pengguna.'],
            [$perusahaan2, 'Digital Marketing', 'Pemasaran', 'Madiun', 'part_time', 'Mengelola konten media sosial dan kampanye iklan digital.', 'Familiar dengan Instagram Ads dan analitik dasar.'],
            [$perusahaan2, 'Magang Content Writer', 'Pemasaran', 'Surabaya', 'magang', 'Menulis artikel dan caption untuk klien agensi.', 'Mahasiswa, kemampuan menulis yang baik.'],
        ];
 
        foreach ($daftar as [$p, $judul, $bidang, $lokasi, $tipe, $deskripsi, $kriteria]) {
            Lowongan::create([
                'id_perusahaan' => $p->id_perusahaan, 'judul_posisi' => $judul, 'bidang' => $bidang,
                'lokasi' => $lokasi, 'tipe_kerja' => $tipe, 'deskripsi' => $deskripsi,
                'kriteria' => $kriteria, 'status' => 'aktif',
            ]);
        }
 
        // ---- Pencari kerja contoh ----
        $pencari = User::create([
            'name' => 'Lathifah Widya Zahra', 'email' => 'zahra@contoh.com',
            'password' => Hash::make('password'), 'role' => 'pencari_kerja',
        ]);
        ProfilPencariKerja::create([
            'id_user' => $pencari->id, 'alamat' => 'Madiun, Jawa Timur',
            'no_telepon' => '081234567890', 'ringkasan' => 'Mahasiswa TRPL yang tertarik pada pengembangan web.',
        ]);
 
        // Riwayat pencarian dibuat SETELAH lowongan agar seeder tidak memicu email.
        // Dipakai untuk demo rekomendasi (KF-04) dan email lowongan baru (KF-05).
        RiwayatPencarian::create([
            'id_user' => $pencari->id, 'bidang' => 'Teknologi Informasi', 'lokasi' => 'Madiun',
        ]);
    }
}
