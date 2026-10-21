@extends('layouts.app')
 
@section('judul', 'Lamaran Saya')
@section('subjudul', 'Pantau status setiap lamaran yang Anda kirim.')
 
@section('konten')
    <div class="card">
        @forelse ($lamaran as $a)
            <div class="row">
                <div>
                    <div style="font-weight:600;">{{ $a->lowongan->judul_posisi }}</div>
                    <div style="font-size:0.82rem; color:var(--ink-soft);">{{ $a->lowongan->perusahaan->nama_perusahaan }} · Dikirim {{ $a->created_at->translatedFormat('d M Y') }}</div>
                </div>
                <span class="badge badge-{{ $a->status }}">{{ ucfirst($a->status) }}</span>
            </div>
        @empty
            <div class="empty-state">Anda belum memiliki riwayat lamaran.</div>
        @endforelse
    </div>
@endsection
