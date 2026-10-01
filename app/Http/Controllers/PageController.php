<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lowongan;
use App\Models\Lamaran;

class PageController extends Controller
{
    public function dashboardPerekrut()
    {
        $jumlahLowonganAktif = Lowongan::where('status', 'aktif')->count();
        $jumlahLamaran = Lamaran::count();
        $jumlahDitinjau = Lamaran::where('status', 'ditinjau')->count();
        $jumlahDiterima = Lamaran::where('status', 'diterima')->count();
        $lamaranTerbaru = Lamaran::with(['profil.user', 'lowongan'])->latest()->take(5)->get();

        return view('perekrut.dashboard', compact(
            'jumlahLowonganAktif',
            'jumlahLamaran',
            'jumlahDitinjau',
            'jumlahDiterima',
            'lamaranTerbaru'
        ));
    }

    public function createLowongan()
    {
        return view('perekrut.lowongan.create');
    }
}