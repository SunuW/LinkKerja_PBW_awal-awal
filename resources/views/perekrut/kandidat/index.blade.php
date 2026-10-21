@extends('layouts.app')
 
@section('judul', 'Kandidat Masuk')
@section('subjudul', 'Tinjau pelamar dan tentukan status lamaran mereka.')
 
@section('konten')
    <div class="card" style="margin-bottom:16px;">
        <form method="GET" action="{{ route('perekrut.kandidat.index') }}" class="grid-2">
            <div class="field" style="margin:0;">
                <label>Filter berdasarkan lowongan</label>
                <select name="id_lowongan" onchange="this.form.submit()">
                    <option value="">Semua lowongan</option>
                    @foreach ($daftarLowongan as $l)
                        <option value="{{ $l->id_lowongan }}" {{ request('id_lowongan') == $l->id_lowongan ? 'selected' : '' }}>{{ $l->judul_posisi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field" style="margin:0;">
                <label>Filter status</label>
                <select name="status" onchange="this.form.submit()">
                    <option value="">Semua status</option>
                    @foreach (['terkirim' => 'Terkirim', 'ditinjau' => 'Ditinjau', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak'] as $value => $label)
                        <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
 
    <div class="card">
        @forelse ($kandidat as $k)
            <div class="row">
                <div style="display:flex; gap:12px; align-items:center;">
                    <div class="cand-avatar"></div>
                    <div>
                        <div style="font-weight:600;">{{ $k->profil->user->name }}</div>
                        <div style="font-size:0.82rem; color:var(--ink-soft);">Melamar: {{ $k->lowongan->judul_posisi }} · {{ $k->created_at->translatedFormat('d M Y') }}</div>
                    </div>
                </div>
                <div style="display:flex; gap:8px; align-items:center;">
                    <span class="badge badge-{{ $k->status }}">{{ ucfirst($k->status) }}</span>
                    @if ($k->dokumen)
                        <a href="{{ asset('storage/' . $k->dokumen->path_file) }}" target="_blank" class="btn btn-outline">Lihat Dokumen</a>
                    @endif
                    <form method="POST" action="{{ route('perekrut.kandidat.updateStatus', $k) }}" style="display:inline;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="diterima">
                        <button type="submit" class="btn btn-success">Terima</button>
                    </form>
                    <form method="POST" action="{{ route('perekrut.kandidat.updateStatus', $k) }}" style="display:inline;">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">Belum ada lamaran yang cocok dengan filter ini.</div>
        @endforelse
    </div>
@endsection
