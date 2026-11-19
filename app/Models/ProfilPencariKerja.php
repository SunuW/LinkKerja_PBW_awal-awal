<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class ProfilPencariKerja extends Model
{
    protected $table = 'profil_pencari_kerja';
    protected $primaryKey = 'id_profil';
 
    protected $fillable = ['id_user', 'alamat', 'no_telepon', 'ringkasan', 'foto_profil'];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
 
    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_profil');
    }
 
    public function pengalamanKerja()
    {
        return $this->hasMany(PengalamanKerja::class, 'id_profil');
    }
 
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_profil');
    }

    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'id_profil', 'id_profil');
    }
}
