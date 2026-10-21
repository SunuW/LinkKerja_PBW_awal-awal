<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikan';
    protected $primaryKey = 'id_pendidikan';
 
    protected $fillable = ['id_profil', 'jenjang', 'institusi', 'jurusan', 'tahun_mulai', 'tahun_selesai'];
 
    public function profil()
    {
        return $this->belongsTo(ProfilPencariKerja::class, 'id_profil');
    }
}
