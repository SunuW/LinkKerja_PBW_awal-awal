@extends('layouts.app')
 
@section('judul', 'Profil & CV')
@section('subjudul', 'Kelola data diri, riwayat, dan dokumen pendukung.')
 
@section('konten')
    <div class="card" style="max-width:640px; margin-bottom:16px;">
        <h3 style="margin-top:0;">Data diri</h3>
        <form method="POST" action="{{ route('pencari.profil.update') }}">
            @csrf @method('PUT')
            <div class="grid-2">
                <div class="field"><label>Nama lengkap</label><input value="{{ auth()->user()->name }}" disabled></div>
                <div class="field"><label>No. telepon</label><input name="no_telepon" value="{{ old('no_telepon', $profil->no_telepon) }}"></div>
            </div>
            <div class="field"><label>Alamat</label><input name="alamat" value="{{ old('alamat', $profil->alamat) }}"></div>
            <div class="field"><label>Ringkasan profesional</label><textarea name="ringkasan" rows="3">{{ old('ringkasan', $profil->ringkasan) }}</textarea></div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
 
    <div class="card" style="max-width:640px; margin-bottom:16px;">
        <h3 style="margin-top:0;">Riwayat pendidikan</h3>
        @forelse ($profil->riwayatPendidikan as $r)
            <div class="row">
                <div>
                    <div style="font-weight:600;">{{ $r->jenjang }} — {{ $r->institusi }}</div>
                    <div style="font-size:0.82rem; color:var(--ink-soft);">{{ $r->tahun_mulai }} - {{ $r->tahun_selesai ?? 'sekarang' }}</div>
                </div>
                <form method="POST" action="{{ route('pencari.profil.riwayat.destroy', $r) }}" onsubmit="return confirm('Hapus riwayat ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-ghost">Hapus</button>
                </form>
            </div>
        @empty
            <div class="empty-state">Belum ada riwayat pendidikan.</div>
        @endforelse
 
        <form method="POST" action="{{ route('pencari.profil.riwayat.store') }}" style="margin-top:14px; border-top:1px solid var(--border); padding-top:14px;">
            @csrf
            <div class="grid-2">
                <div class="field"><label>Jenjang</label><input name="jenjang" placeholder="D-IV" required></div>
                <div class="field"><label>Institusi</label><input name="institusi" placeholder="Politeknik Negeri Madiun" required></div>
            </div>
            <div class="grid-2">
                <div class="field"><label>Tahun mulai</label><input name="tahun_mulai" placeholder="2023" required></div>
                <div class="field"><label>Tahun selesai (kosongkan jika masih berjalan)</label><input name="tahun_selesai" placeholder="2027"></div>
            </div>
            <button type="submit" class="btn btn-outline">+ Tambah riwayat</button>
        </form>
    </div>
 
    <div class="card" style="max-width:640px;">
        <h3 style="margin-top:0;">Dokumen pendukung</h3>
        <p style="font-size:0.85rem; color:var(--ink-soft); margin-top:-6px;">Format yang diterima: PDF atau JPG.</p>
        @forelse ($profil->dokumen as $d)
            <div class="row"><div>📎 {{ $d->nama_file }}</div></div>
        @empty
            <div class="empty-state">Belum ada dokumen diunggah.</div>
        @endforelse
 
        <form method="POST" action="{{ route('pencari.profil.dokumen.store') }}" enctype="multipart/form-data" style="margin-top:10px;">
            @csrf
            <input type="hidden" name="jenis" value="lainnya">
            <input type="file" name="dokumen" accept=".pdf,.jpg,.jpeg" required>
            <button type="submit" class="btn btn-outline" style="margin-top:8px;">+ Unggah dokumen</button>
        </form>
    </div>
@endsection
