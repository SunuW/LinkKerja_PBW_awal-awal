<?php
 
namespace App\Http\Controllers;
 
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class LowonganController extends Controller
{
    // ---------- Sisi Perekrut ----------
 
    // Manajemen Lowongan (KF-07)
    public function index()
    {
        $lowongan = Auth::user()->perusahaan->lowongan()->latest()->get();
 
        return view('perekrut.lowongan.index', compact('lowongan'));
    }
 
    // Form Publikasi Lowongan (UC-05)
    public function create()
    {
        return view('perekrut.lowongan.create');
    }
 
    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['id_perusahaan'] = Auth::user()->perusahaan->id_perusahaan;
 
        Lowongan::create($data);
 
        return redirect()->route('perekrut.lowongan.index')->with('sukses', 'Lowongan berhasil dipublikasikan.');
    }
 
    public function edit(Lowongan $lowongan)
    {
        $this->pastikanMilikSaya($lowongan);
 
        return view('perekrut.lowongan.edit', compact('lowongan'));
    }
 
    public function update(Request $request, Lowongan $lowongan)
    {
        $this->pastikanMilikSaya($lowongan);
        $lowongan->update($this->validated($request));
 
        return redirect()->route('perekrut.lowongan.index')->with('sukses', 'Lowongan berhasil diperbarui.');
    }
 
    public function toggleStatus(Lowongan $lowongan)
    {
        $this->pastikanMilikSaya($lowongan);
        $lowongan->update(['status' => $lowongan->status === 'aktif' ? 'nonaktif' : 'aktif']);
 
        return back()->with('sukses', 'Status lowongan diperbarui.');
    }
 
    public function destroy(Lowongan $lowongan)
    {
        $this->pastikanMilikSaya($lowongan);
        $lowongan->delete();
 
        return back()->with('sukses', 'Lowongan dihapus.');
    }
 
    // ---------- Sisi Pencari Kerja ----------
 
    // Cari Lowongan dengan filter (KF-03, UC-03)
    public function cari(Request $request)
    {
        $lowongan = Lowongan::where('status', 'aktif')
            ->filter($request->only('kata_kunci', 'bidang'))
            ->with('perusahaan')
            ->latest()
            ->get();
 
        return view('pencari.cari', compact('lowongan'));
    }
 
    // Detail Lowongan (UC-04)
    public function show(Lowongan $lowongan)
    {
        return view('pencari.detail', compact('lowongan'));
    }
 
    // ---------- Helper ----------
 
    private function validated(Request $request): array
    {
        return $request->validate([
            'judul_posisi' => ['required', 'string', 'max:150'],
            'bidang' => ['required', 'string', 'max:100'],
            'lokasi' => ['required', 'string', 'max:150'],
            'tipe_kerja' => ['required', 'in:full_time,part_time,magang,kontrak'],
            'deskripsi' => ['required', 'string'],
            'kriteria' => ['required', 'string'],
        ]);
    }
 
    private function pastikanMilikSaya(Lowongan $lowongan): void
    {
        abort_unless($lowongan->id_perusahaan === Auth::user()->perusahaan->id_perusahaan, 403);
    }
}
