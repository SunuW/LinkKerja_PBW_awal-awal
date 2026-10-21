<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class PengalamanKerja extends Model
{
    protected $table = 'pengalaman_kerja';
    protected $primaryKey = 'id_pengalaman';
 
    protected $fillable = ['id_profil', 'posisi', 'perusahaan', 'tahun_mulai', 'tahun_selesai', 'deskripsi'];
 
    public function profil()
    {
        return $this->belongsTo(ProfilPencariKerja::class, 'id_profil');
    }
}
