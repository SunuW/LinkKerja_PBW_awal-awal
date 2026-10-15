@extends('layouts.app')
 
@section('judul', 'Beranda')
@section('subjudul', 'Rekomendasi lowongan untuk Anda hari ini.')
 
@section('konten')
    <div class="card">
        <h3 style="margin-top:0;">Rekomendasi untuk Anda</h3>
 
        @if ($riwayat->isNotEmpty())
            <p style="font-size:0.85rem; color:var(--ink-soft); margin-top:-6px;">
                Berdasarkan pencarian Anda:
                {{ $riwayat->pluck('bidang')->merge($riwayat->pluck('lokasi'))->filter()->unique()->implode(', ') }}
            </p>
        @else
            <p style="font-size:0.85rem; color:var(--ink-soft); margin-top:-6px;">Belum ada riwayat pencarian — menampilkan lowongan terbaru. Coba menu Cari Lowongan agar rekomendasi lebih sesuai.</p>
        @endif
 
        @forelse ($rekomendasi as $l)
            <div class="row">
                <div style="display:flex; gap:12px; align-items:center;">
                    <div class="job-logo"></div>
                    <div>
                        <div style="font-weight:600;">{{ $l->judul_posisi }}</div>
                        <div style="font-size:0.82rem; color:var(--ink-soft);">{{ $l->perusahaan->nama_perusahaan }} · {{ $l->lokasi }} · {{ ucfirst(str_replace('_', '-', $l->tipe_kerja)) }}</div>
                    </div>
                </div>
                <a href="{{ route('pencari.detail', $l) }}" class="btn btn-outline">Lihat Detail</a>
            </div>
        @empty
            <div class="empty-state">Belum ada lowongan tersedia saat ini.</div>
        @endforelse
    </div>
@endsection
