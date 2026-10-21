<?php
 
namespace App\Console\Commands;
 
use App\Models\Lowongan;
use App\Models\Perusahaan;
use Illuminate\Console\Command;
 
class TambahLowonganContoh extends Command
{
    protected $signature = 'lowongan:tambah-contoh {judul=Backend Developer} {--bidang=Teknologi Informasi} {--lokasi=Madiun}';
 
    protected $description = 'Membuat satu lowongan contoh untuk menguji email lowongan baru (KF-05)';
 
    public function handle(): int
    {
        $perusahaan = Perusahaan::first();
 
        if (! $perusahaan) {
            $this->error('Belum ada perusahaan. Jalankan seeder terlebih dahulu.');
 
            return self::FAILURE;
        }
 
        $lowongan = Lowongan::create([
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'judul_posisi' => $this->argument('judul'),
            'bidang' => $this->option('bidang'),
            'lokasi' => $this->option('lokasi'),
            'tipe_kerja' => 'full_time',
            'deskripsi' => 'Lowongan contoh untuk pengujian email.',
            'kriteria' => 'Bersedia belajar dan bekerja dalam tim.',
            'status' => 'aktif',
        ]);
 
        $this->info("Lowongan '{$lowongan->judul_posisi}' dibuat. Cek email di storage/logs/laravel.log (MAIL_MAILER=log).");
 
        return self::SUCCESS;
    }
}
