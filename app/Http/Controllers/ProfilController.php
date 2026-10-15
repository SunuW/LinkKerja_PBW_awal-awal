<?php
 
namespace App\Http\Controllers;
 
use App\Models\Dokumen;
use App\Models\PengalamanKerja;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
 
class ProfilController extends Controller
{
    // ---------- Perekrut (KF-01) ----------
 
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
 
    // ---------- Pencari Kerja (KF-01, KF-02, UC-02) ----------
 
    public function pencariKerja()
    {
        $profil = Auth::user()->profilPencariKerja()
            ->with(['riwayatPendidikan', 'pengalamanKerja', 'dokumen'])
            ->first();
 
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
 
    public function hapusRiwayat(RiwayatPendidikan $riwayat)
    {
        abort_unless($riwayat->id_profil === $this->idProfil(), 403);
        $riwayat->delete();
 
        return back()->with('sukses', 'Riwayat pendidikan dihapus.');
    }
 
    public function tambahPengalaman(Request $request)
    {
        $data = $request->validate([
            'posisi' => ['required', 'string', 'max:100'],
            'perusahaan' => ['required', 'string', 'max:150'],
            'tahun_mulai' => ['required', 'digits:4'],
            'tahun_selesai' => ['nullable', 'digits:4'],
            'deskripsi' => ['nullable', 'string'],
        ]);
 
        Auth::user()->profilPencariKerja->pengalamanKerja()->create($data);
 
        return back()->with('sukses', 'Pengalaman kerja ditambahkan.');
    }
 
    public function hapusPengalaman(PengalamanKerja $pengalaman)
    {
        abort_unless($pengalaman->id_profil === $this->idProfil(), 403);
        $pengalaman->delete();
 
        return back()->with('sukses', 'Pengalaman kerja dihapus.');
    }
 
    // Mengunggah dokumen pendukung: sertifikat, portofolio, dll (KF-02)
    public function unggahDokumen(Request $request)
    {
        $request->validate([
            'jenis' => ['required', 'in:cv,sertifikat,portofolio,lainnya'],
            'dokumen' => ['required', 'file', 'mimes:pdf,jpg,jpeg', 'max:2048'],
        ], [
            'dokumen.mimes' => 'Unggah file dalam bentuk PDF atau JPG.',
        ]);
 
        $path = $request->file('dokumen')->store('dokumen-profil', 'public');
 
        Auth::user()->profilPencariKerja->dokumen()->create([
            'jenis' => $request->jenis,
            'nama_file' => $request->file('dokumen')->getClientOriginalName(),
            'path_file' => $path,
        ]);
 
        return back()->with('sukses', 'Dokumen berhasil diunggah.');
    }
 
    public function hapusDokumen(Dokumen $dokumen)
    {
        abort_unless($dokumen->id_profil === $this->idProfil(), 403);
 
        Storage::disk('public')->delete($dokumen->path_file);
        $dokumen->delete();
 
        return back()->with('sukses', 'Dokumen dihapus.');
    }
 
    private function idProfil(): int
    {
        return Auth::user()->profilPencariKerja->id_profil;
    }
}
