<?php
 
namespace App\Http\Controllers;
 
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LowonganController extends Controller
{
    // Cari Lowongan dengan filter (KF-03, UC-03)
    public function cari(Request $request)
    {
        $filter = array_filter(
            $request->only('kata_kunci', 'lokasi', 'bidang'),
            fn ($nilai) => filled($nilai)
        );
 
        // Simpan pencarian sebagai riwayat (dipakai KF-04 dan KF-05)
        if ($filter) {
            Auth::user()->riwayatPencarian()->firstOrCreate($filter);
        }
 
        $lowongan = Lowongan::where('status', 'aktif')
            ->filter($filter)
            ->with('perusahaan')
            ->latest()
            ->get();
 
        $daftarBidang = Lowongan::where('status', 'aktif')->distinct()->orderBy('bidang')->pluck('bidang');
 
        return view('pencari.cari', compact('lowongan', 'daftarBidang'));
    }
 
    // Detail Lowongan
    public function show(Lowongan $lowongan)
    {
        return view('pencari.detail', compact('lowongan'));
    }
}
