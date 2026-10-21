@extends('layouts.app')
 
@section('judul', 'Manajemen Lowongan')
@section('subjudul', 'Kelola, ubah, atau nonaktifkan lowongan yang sudah dipasang.')
 
@section('konten')
    <div class="card">
        @forelse ($lowongan as $l)
            <div class="row">
                <div style="display:flex; gap:12px; align-items:center;">
                    <div class="job-logo"></div>
                    <div>
                        <div style="font-weight:600;">{{ $l->judul_posisi }}</div>
                        <div style="font-size:0.82rem; color:var(--ink-soft);">{{ $l->bidang }} · {{ $l->lokasi }} · {{ ucfirst(str_replace('_', '-', $l->tipe_kerja)) }}</div>
                    </div>
                </div>
                <div style="display:flex; gap:8px; align-items:center;">
                    <span class="badge badge-{{ $l->status }}">{{ ucfirst($l->status) }}</span>
                    <a href="{{ route('perekrut.lowongan.edit', $l) }}" class="btn btn-outline">Edit</a>
                    <form method="POST" action="{{ route('perekrut.lowongan.toggleStatus', $l) }}" style="display:inline;">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-outline">{{ $l->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                    </form>
                    <form method="POST" action="{{ route('perekrut.lowongan.destroy', $l) }}" style="display:inline;" onsubmit="return confirm('Hapus lowongan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">Belum ada lowongan. Buat lowongan pertama Anda di menu "Publikasi Lowongan".</div>
        @endforelse
    </div>
@endsection
