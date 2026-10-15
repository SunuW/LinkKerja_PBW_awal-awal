<?php
 
namespace App\Models;
 
use App\Observers\LowonganObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
 
// Observer dipanggil otomatis setiap ada lowongan baru (KF-05: email lowongan baru)
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
 
    // Query scope untuk pencarian dengan filter (KF-03)
    public function scopeFilter($query, array $data)
    {
        return $query
            ->when($data['kata_kunci'] ?? null, fn ($q, $v) => $q->where('judul_posisi', 'like', "%{$v}%"))
            ->when($data['lokasi'] ?? null, fn ($q, $v) => $q->where('lokasi', 'like', "%{$v}%"))
            ->when($data['bidang'] ?? null, fn ($q, $v) => $q->where('bidang', $v));
    }
}
