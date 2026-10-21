<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Lamaran extends Model
{
    protected $table = 'lamaran';
    protected $primaryKey = 'id_lamaran';
 
    protected $fillable = ['id_lowongan', 'id_profil', 'id_dokumen', 'status'];
 
    public function lowongan()
    {
            return $this->belongsTo(Lowongan::class, 'id_lowongan');
    }
 
    public function profil()
    {
        return $this->belongsTo(ProfilPencariKerja::class, 'id_profil');
    }
 
    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'id_dokumen');
    }
}


