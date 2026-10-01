@extends('layouts.app')
 
@section('judul', 'Dasbor')
@section('subjudul', 'Ringkasan aktivitas rekrutmen Anda hari ini.')
 
@section('konten')
    <div class="stat-grid">
        <div class="stat-card"><div class="accent"></div><div class="num">{{ $jumlahLowonganAktif }}</div><div class="label">Lowongan aktif</div></div>
        <div class="stat-card"><div class="accent"></div><div class="num">{{ $jumlahLamaran }}</div><div class="label">Lamaran masuk</div></div>
        <div class="stat-card"><div class="accent"></div><div class="num">{{ $jumlahDitinjau }}</div><div class="label">Menunggu ditinjau</div></div>
        <div class="stat-card"><div class="accent"></div><div class="num">{{ $jumlahDiterima }}</div><div class="label">Kandidat diterima</div></div>
    </div>
 
    <div class="card">
        <h3 style="margin-top:0;">Lamaran terbaru</h3>
        @forelse ($lamaranTerbaru as $lamaran)
            <div class="row">
                <div>{{ $lamaran->profil->user->name }} melamar sebagai <strong>{{ $lamaran->lowongan->judul_posisi }}</strong></div>
                <span class="badge badge-{{ $lamaran->status }}">{{ ucfirst($lamaran->status) }}</span>
            </div>
        @empty
            <div class="empty-state">Belum ada aktivitas.</div>
        @endforelse
    </div>
@endsection