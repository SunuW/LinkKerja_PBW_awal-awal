@extends('layouts.app')
 
@section('judul', 'Publikasi Lowongan')
@section('subjudul', 'Buat lowongan baru agar dapat dilihat pencari kerja.')
 
@section('konten')
    <div class="card" style="max-width:640px;">
        <h3 style="margin-top:0;">Formulir lowongan baru</h3>
        <form method="POST" action="{{ route('perekrut.lowongan.store') }}">
            @csrf
            <div class="field"><label>Posisi yang dibutuhkan</label><input name="judul_posisi" value="{{ old('judul_posisi') }}" required placeholder="Contoh: Frontend Developer"></div>
            <div class="grid-2">
                <div class="field"><label>Bidang</label><input name="bidang" value="{{ old('bidang') }}" required placeholder="Teknologi Informasi"></div>
                <div class="field"><label>Lokasi</label><input name="lokasi" value="{{ old('lokasi') }}" required placeholder="Madiun"></div>
            </div>
            <div class="field">
                <label>Tipe kerja</label>
                <select name="tipe_kerja">
                    <option value="full_time">Full-time</option>
                    <option value="part_time">Part-time</option>
                    <option value="magang">Magang</option>
                    <option value="kontrak">Kontrak</option>
                </select>
            </div>
            <div class="field"><label>Deskripsi pekerjaan</label><textarea name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea></div>
            <div class="field"><label>Kriteria kandidat</label><textarea name="kriteria" rows="3" required>{{ old('kriteria') }}</textarea></div>
            <button type="submit" class="btn btn-primary">Unggah</button>
        </form>
    </div>
@endsection