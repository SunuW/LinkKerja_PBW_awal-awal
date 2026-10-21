<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
 
    protected $fillable = ['id_profil', 'jenis', 'nama_file', 'path_file'];
 
    public function profil()
    {
        return $this->belongsTo(ProfilPencariKerja::class, 'id_profil');
    }
}
