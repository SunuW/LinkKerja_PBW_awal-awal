@extends('layouts.app')
 
@section('judul', 'Cari Lowongan')
@section('subjudul', 'Gunakan filter lokasi dan bidang untuk menemukan lowongan yang relevan.')
 
@section('konten')
    <div class="card" style="margin-bottom:16px;">
        <form method="GET" action="{{ route('pencari.cari') }}">
            <div class="grid-2">
                <div class="field" style="margin:0;">
                    <label>Posisi / kata kunci</label>
                    <input type="text" name="kata_kunci" value="{{ request('kata_kunci') }}" placeholder="Contoh: Developer">
                </div>
                <div class="field" style="margin:0;">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Contoh: Madiun">
                </div>
                <div class="field" style="margin:0;">
                    <label>Bidang</label>
                    <select name="bidang">
                        <option value="">Semua bidang</option>
                        @foreach ($daftarBidang as $bidang)
                            <option value="{{ $bidang }}" {{ request('bidang') === $bidang ? 'selected' : '' }}>{{ $bidang }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display:flex; align-items:flex-end; gap:8px;">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('pencari.cari') }}" class="btn btn-ghost">Reset</a>
                </div>
            </div>
        </form>
    </div>
 
    <div class="card">
        @forelse ($lowongan as $l)
            <div class="row">
                <div style="display:flex; gap:12px; align-items:center;">
                    <div class="job-logo"></div>
                    <div>
                        <div style="font-weight:600;">{{ $l->judul_posisi }}</div>
                        <div style="font-size:0.82rem; color:var(--ink-soft);">{{ $l->perusahaan->nama_perusahaan }} · {{ $l->lokasi }} · {{ $l->bidang }} · {{ ucfirst(str_replace('_', '-', $l->tipe_kerja)) }}</div>
                    </div>
                </div>
                <a href="{{ route('pencari.detail', $l) }}" class="btn btn-outline">Lihat Detail</a>
            </div>
        @empty
            <div class="empty-state">Tidak ditemukan hasil yang relevan.</div>
        @endforelse
    </div>
@endsection
