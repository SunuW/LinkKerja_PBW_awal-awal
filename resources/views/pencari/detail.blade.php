@extends('layouts.app')
 
@section('judul', 'Detail Lowongan')
@section('subjudul', 'Tinjau detail sebelum mengirim lamaran.')
 
@section('konten')
    <a href="{{ route('pencari.cari') }}" class="btn btn-ghost">← Kembali ke daftar lowongan</a>
 
    <div class="card" style="margin-top:14px;">
        <div style="display:flex; gap:14px; align-items:center; margin-bottom:16px;">
            <div class="job-logo" style="width:56px; height:56px;"></div>
            <div>
                <h2 style="margin:0;">{{ $lowongan->judul_posisi }}</h2>
                <p style="margin:2px 0; color:var(--ink-soft);">{{ $lowongan->perusahaan->nama_perusahaan }} · {{ $lowongan->lokasi }} · {{ ucfirst(str_replace('_', '-', $lowongan->tipe_kerja)) }} · {{ $lowongan->bidang }}</p>
            </div>
        </div>
 
        <h4>Deskripsi pekerjaan</h4>
        <p>{{ $lowongan->deskripsi }}</p>
        <h4>Kriteria</h4>
        <p>{{ $lowongan->kriteria }}</p>
 
        <form method="POST" action="{{ route('pencari.lamar', $lowongan) }}" enctype="multipart/form-data">
            @csrf
            <div class="field" style="max-width:360px;">
                <label>Unggah dokumen pendukung (PDF/JPG)</label>
                <input type="file" name="dokumen" accept=".pdf,.jpg,.jpeg" required>
            </div>
            <button type="submit" class="btn btn-primary">Lamar Sekarang</button>
        </form>
    </div>
@endsection
