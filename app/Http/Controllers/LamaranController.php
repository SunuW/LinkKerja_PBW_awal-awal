<?php
 
namespace App\Http\Controllers;
 
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LamaranController extends Controller
{
    // ---------- Sisi Pencari Kerja ----------
 
    // Melamar Pekerjaan (UC-04)
    public function store(Request $request, Lowongan $lowongan)
    {
        $request->validate([
            'dokumen' => ['required', 'file', 'mimes:pdf,jpg,jpeg', 'max:2048'],
        ], [
            'dokumen.mimes' => 'Unggah file dalam bentuk PDF atau JPG.',
        ]);
 
        $profil = Auth::user()->profilPencariKerja;
 
        $sudahMelamar = Lamaran::where('id_lowongan', $lowongan->id_lowongan)
            ->where('id_profil', $profil->id_profil)
            ->exists();
 
        if ($sudahMelamar) {
            return back()->with('gagal', 'Anda sudah pernah melamar posisi ini.');
        }
 
        $path = $request->file('dokumen')->store('dokumen-lamaran', 'public');
        $dokumen = $profil->dokumen()->create([
            'jenis' => 'cv',
            'nama_file' => $request->file('dokumen')->getClientOriginalName(),
            'path_file' => $path,
        ]);
 
        Lamaran::create([
            'id_lowongan' => $lowongan->id_lowongan,
            'id_profil' => $profil->id_profil,
            'id_dokumen' => $dokumen->id_dokumen,
            'status' => 'terkirim',
        ]);
 
        return redirect()->route('pencari.lamaran.index')->with('sukses', 'Lamaran berhasil terkirim.');
    }
 
    // Lamaran Saya / application tracker (KF-06, UC-07)
    public function index()
    {
        $lamaran = Auth::user()->profilPencariKerja
            ->lamaran()
            ->with('lowongan.perusahaan')
            ->latest()
            ->get();
 
        return view('pencari.lamaran', compact('lamaran'));
    }
 
    // ---------- Sisi Perekrut ----------
 
    // Kandidat Masuk dengan filter (UC-06)
    public function kandidat(Request $request)
    {
        $lowonganSaya = Auth::user()->perusahaan->lowongan()->pluck('id_lowongan');
 
        $kandidat = Lamaran::whereIn('id_lowongan', $lowonganSaya)
            ->when($request->id_lowongan, fn ($q, $id) => $q->where('id_lowongan', $id))
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->with(['profil.user', 'lowongan', 'dokumen'])
            ->latest()
            ->get();
 
        $daftarLowongan = Auth::user()->perusahaan->lowongan;
 
        return view('perekrut.kandidat.index', compact('kandidat', 'daftarLowongan'));
    }
 
    // Mengubah status lamaran: diterima/ditolak/ditinjau (UC-06)
    public function updateStatus(Request $request, Lamaran $lamaran)
    {
        $request->validate(['status' => ['required', 'in:ditinjau,diterima,ditolak']]);
 
        abort_unless(
            $lamaran->lowongan->id_perusahaan === Auth::user()->perusahaan->id_perusahaan,
            403
        );
 
        $lamaran->update(['status' => $request->status]);
 
        return back()->with('sukses', 'Status lamaran diperbarui.');
    }
}
