<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class RiwayatPencarian extends Model
{
    protected $table = 'riwayat_pencarian';
    protected $primaryKey = 'id_riwayat';
 
    protected $fillable = ['id_user', 'kata_kunci', 'lokasi', 'bidang'];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
