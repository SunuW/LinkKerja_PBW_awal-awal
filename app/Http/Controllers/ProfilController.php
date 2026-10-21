<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class ProfilController extends Controller
{
    // ---------- Sisi Perekrut ----------
 
    public function perusahaan()
    {
        return view('perekrut.profil', ['perusahaan' => Auth::user()->perusahaan]);
    }
 
    public function updatePerusahaan(Request $request)
    {
        $data = $request->validate([
            'nama_perusahaan' => ['required', 'string', 'max:150'],
            'bidang' => ['nullable', 'string', 'max:100'],
            'lokasi' => ['nullable', 'string', 'max:150'],
            'deskripsi' => ['nullable', 'string'],
        ]);
 
        Auth::user()->perusahaan->update($data);
 
        return back()->with('sukses', 'Profil perusahaan diperbarui.');
    }
 
    // ---------- Sisi Pencari Kerja (KF-01, KF-02, UC-02) ----------
 
    public function pencariKerja()
    {
        $profil = Auth::user()->profilPencariKerja()->with(['riwayatPendidikan', 'pengalamanKerja', 'dokumen'])->first();
 
        return view('pencari.profil', compact('profil'));
    }
 
    public function updatePencariKerja(Request $request)
    {
        $data = $request->validate([
            'alamat' => ['nullable', 'string', 'max:255'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'ringkasan' => ['nullable', 'string'],
        ]);
 
        Auth::user()->profilPencariKerja->update($data);
 
        return back()->with('sukses', 'Profil berhasil diperbarui.');
    }
 
    public function tambahRiwayat(Request $request)
    {
        $data = $request->validate([
            'jenjang' => ['required', 'string', 'max:50'],
            'institusi' => ['required', 'string', 'max:150'],
            'jurusan' => ['nullable', 'string', 'max:100'],
            'tahun_mulai' => ['required', 'digits:4'],
            'tahun_selesai' => ['nullable', 'digits:4'],
        ]);
 
        Auth::user()->profilPencariKerja->riwayatPendidikan()->create($data);
 
        return back()->with('sukses', 'Riwayat pendidikan ditambahkan.');
    }
 
    public function hapusRiwayat(\App\Models\RiwayatPendidikan $riwayat)
    {
        abort_unless($riwayat->id_profil === Auth::user()->profilPencariKerja->id_profil, 403);
        $riwayat->delete();
 
        return back()->with('sukses', 'Riwayat pendidikan dihapus.');
    }
 
    public function unggahDokumen(Request $request)
    {
        $request->validate([
            'dokumen' => ['required', 'file', 'mimes:pdf,jpg,jpeg', 'max:2048'],
        ], [
            'dokumen.mimes' => 'Unggah file dalam bentuk PDF atau JPG.',
        ]);
 
        $path = $request->file('dokumen')->store('dokumen-profil', 'public');
 
        Auth::user()->profilPencariKerja->dokumen()->create([
            'jenis' => $request->input('jenis', 'lainnya'),
            'nama_file' => $request->file('dokumen')->getClientOriginalName(),
            'path_file' => $path,
        ]);
 
        return back()->with('sukses', 'Dokumen berhasil diunggah.');
    }
}