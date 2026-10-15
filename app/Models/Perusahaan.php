<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'id_perusahaan';
 
    protected $fillable = ['id_user', 'nama_perusahaan', 'bidang', 'lokasi', 'deskripsi', 'logo'];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
 
    public function lowongan()
    {
        return $this->hasMany(Lowongan::class, 'id_perusahaan');
    }
}
