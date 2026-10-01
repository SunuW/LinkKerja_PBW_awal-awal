@extends('layouts.guest')

@section('judul', 'Masuk')

@section('hero')
    <h2>Selamat datang kembali di LinkKerja.</h2>   
    <p>Masuk untuk melanjutkan sebagai pencari kerja atau perekrut.</p>
@endsection

@section('konten')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
        </div>
        <div class="field">
            <label>Kata sandi</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Masuk</button>
        <p style="font-size:0.82rem; color:var(--ink-soft); margin-top:12px;">Belum punya akun? Klik "Daftar" di atas.</p>
    </form>
@endsection