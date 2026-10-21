<?php

namespace App\Models;

use App\Observers\LowonganObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
// Observer dipanggil otomatis saat lowongan baru dibuat (KF-05).
#[ObservedBy([LowonganObserver::class])]
class Lowongan extends Model
{
    protected $table = 'lowongan';
    protected $primaryKey = 'id_lowongan';
 
    protected $fillable = ['id_perusahaan', 'judul_posisi', 'bidang', 'lokasi', 'tipe_kerja', 'deskripsi', 'kriteria', 'status'];
 
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
 
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'id_lowongan');
    }
    // Query scope untuk pencarian & filter (KF-03, UC-03)
    public function scopeFilter($query, array $data)
    {
        return $query
            ->when($data['kata_kunci'] ?? null, fn ($q, $kk) => $q->where(function ($q2) use ($kk) {
                $q2->where('judul_posisi', 'like', "%{$kk}%")->orWhere('lokasi', 'like', "%{$kk}%");
            }))
            ->when($data['bidang'] ?? null, fn ($q, $b) => $q->where('bidang', $b));
    }
}
