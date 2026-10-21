<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Auth;
 
class DashboardController extends Controller
{
    // Dasbor Perekrut — ringkasan lowongan & lamaran (deskripsi umum sistem)
    public function perekrut()
    {
        $perusahaan = Auth::user()->perusahaan;
        $lowongan = $perusahaan->lowongan()->with('lamaran.profil.user')->get();
 
        $totalLamaran = $lowongan->flatMap->lamaran;
 
        return view('perekrut.dashboard', [
            'jumlahLowonganAktif' => $lowongan->where('status', 'aktif')->count(),
            'jumlahLamaran' => $totalLamaran->count(),
            'jumlahDitinjau' => $totalLamaran->whereIn('status', ['terkirim', 'ditinjau'])->count(),
            'jumlahDiterima' => $totalLamaran->where('status', 'diterima')->count(),
            'lamaranTerbaru' => $totalLamaran->sortByDesc('created_at')->take(5),
        ]);
    }
 
    // Beranda Pencari Kerja — rekomendasi lowongan (KF-04)
    public function pencari()
    {
        $rekomendasi = \App\Models\Lowongan::where('status', 'aktif')
            ->with('perusahaan')
            ->latest()
            ->take(3)
            ->get();
 
        return view('pencari.beranda', ['rekomendasi' => $rekomendasi]);
    }
}
