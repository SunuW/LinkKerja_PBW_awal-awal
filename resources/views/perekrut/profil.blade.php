@extends('layouts.app')
 
@section('judul', 'Profil Perusahaan')
@section('subjudul', 'Data ini akan tampil pada setiap lowongan yang Anda pasang.')
 
@section('konten')
    <div class="card" style="max-width:560px; margin-bottom:16px;">
    <div class="card" style="max-width:560px;">
        <h3 style="margin-top:0;">Data perusahaan</h3>
        <form method="POST" action="{{ route('perekrut.profil.update') }}">
            @csrf @method('PUT')
            <div class="field"><label>Nama perusahaan</label><input name="nama_perusahaan" value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" required></div>
            <div class="field"><label>Bidang</label><input name="bidang" value="{{ old('bidang', $perusahaan->bidang) }}"></div>
            <div class="field"><label>Lokasi</label><input name="lokasi" value="{{ old('lokasi', $perusahaan->lokasi) }}"></div>
            <div class="field"><label>Deskripsi</label><textarea name="deskripsi" rows="3">{{ old('deskripsi', $perusahaan->deskripsi) }}</textarea></div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
 
    <div class="card" style="max-width:560px;">
        <strong>Segera hadir</strong>
        <p style="margin:6px 0 0; color:var(--ink-soft);">Fitur memublikasikan lowongan dan mengelola kandidat akan tersedia pada tahap pengembangan berikutnya.</p>
    </div>
@endsection
