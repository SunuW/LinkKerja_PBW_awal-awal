<?php
 
namespace App\Observers;
 
use App\Mail\LowonganBaruMail;
use App\Models\Lowongan;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
 
class LowonganObserver
{
    /**
     * Dipanggil otomatis setelah sebuah Lowongan berhasil dibuat.
     * Kirim email ke pencari kerja yang riwayat pencariannya cocok (KF-05).
     */
    public function created(Lowongan $lowongan): void
    {
        $lowongan->loadMissing('perusahaan');
 
        $penerima = User::where('role', 'pencari_kerja')
            ->whereHas('riwayatPencarian', function ($q) use ($lowongan) {
                $q->where('bidang', $lowongan->bidang)
                    ->orWhere(fn ($w) => $w->whereNotNull('lokasi')
                        ->whereRaw("? LIKE CONCAT('%', lokasi, '%')", [$lowongan->lokasi]))
                    ->orWhere(fn ($w) => $w->whereNotNull('kata_kunci')
                        ->whereRaw("? LIKE CONCAT('%', kata_kunci, '%')", [$lowongan->judul_posisi]));
            })
            ->get();
 
        foreach ($penerima as $user) {
            Mail::to($user->email)->send(new LowonganBaruMail($lowongan, $user));
        }
    }
}
