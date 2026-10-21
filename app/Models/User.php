<?php
 
namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable
{
    use Notifiable;
 
    protected $fillable = ['name', 'email', 'password', 'role'];
 
    protected $hidden = ['password', 'remember_token'];
 
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }
 
    public function profilPencariKerja()
    {
        return $this->hasOne(ProfilPencariKerja::class, 'id_user');
    }
 
    public function perusahaan()
    {
        return $this->hasOne(Perusahaan::class, 'id_user');
    }
 
    public function riwayatPencarian()
    {
        return $this->hasMany(RiwayatPencarian::class, 'id_user');
    }
 
    public function isPerekrut(): bool
    {
        return $this->role === 'perekrut';
    }
 
    public function isPencariKerja(): bool
    {
        return $this->role === 'pencari_kerja';
    }
}
