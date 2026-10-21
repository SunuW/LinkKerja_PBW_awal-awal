@extends('layouts.app')
 
@section('judul', 'Edit Lowongan')
@section('subjudul', 'Perbarui detail lowongan yang sudah dipublikasikan.')
 
@section('konten')
    <div class="card" style="max-width:640px;">
        <form method="POST" action="{{ route('perekrut.lowongan.update', $lowongan) }}">
            @csrf @method('PUT')
            <div class="field"><label>Posisi yang dibutuhkan</label><input name="judul_posisi" value="{{ old('judul_posisi', $lowongan->judul_posisi) }}" required></div>
            <div class="grid-2">
                <div class="field"><label>Bidang</label><input name="bidang" value="{{ old('bidang', $lowongan->bidang) }}" required></div>
                <div class="field"><label>Lokasi</label><input name="lokasi" value="{{ old('lokasi', $lowongan->lokasi) }}" required></div>
            </div>
            <div class="field">
                <label>Tipe kerja</label>
                <select name="tipe_kerja">
                    @foreach (['full_time' => 'Full-time', 'part_time' => 'Part-time', 'magang' => 'Magang', 'kontrak' => 'Kontrak'] as $value => $label)
                        <option value="{{ $value }}" {{ old('tipe_kerja', $lowongan->tipe_kerja) === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field"><label>Deskripsi pekerjaan</label><textarea name="deskripsi" rows="3" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea></div>
            <div class="field"><label>Kriteria kandidat</label><textarea name="kriteria" rows="3" required>{{ old('kriteria', $lowongan->kriteria) }}</textarea></div>
            <div style="display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('perekrut.lowongan.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection
