<?php
 
namespace App\Http\Controllers;
 
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
 
class DashboardController extends Controller
{
    // Beranda Pencari Kerja — rekomendasi lowongan (KF-04)
    public function pencari()
    {
        $riwayat = Auth::user()->riwayatPencarian()->latest()->take(5)->get();
 
        $bidang = $riwayat->pluck('bidang')->filter()->unique();
        $lokasi = $riwayat->pluck('lokasi')->filter()->unique();
 
        $rekomendasi = collect();
 
        // Rekomendasi berdasarkan riwayat pencarian: bidang atau lokasi yang pernah dicari
        if ($bidang->isNotEmpty() || $lokasi->isNotEmpty()) {
            $rekomendasi = Lowongan::where('status', 'aktif')
                ->where(function ($q) use ($bidang, $lokasi) {
                    $q->whereIn('bidang', $bidang);
                    foreach ($lokasi as $l) {
                        $q->orWhere('lokasi', 'like', "%{$l}%");
                    }
                })
                ->with('perusahaan')
                ->latest()
                ->take(5)
                ->get();
        }
 
        // Belum ada riwayat / tidak ada yang cocok: tampilkan lowongan terbaru
        if ($rekomendasi->isEmpty()) {
            $rekomendasi = Lowongan::where('status', 'aktif')->with('perusahaan')->latest()->take(5)->get();
        }
 
        return view('pencari.beranda', compact('rekomendasi', 'riwayat'));
    }
}
