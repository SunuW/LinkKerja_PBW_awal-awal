@extends('layouts.guest')
 
@section('judul', 'Daftar')
 
@section('hero')
    <h2>Buat akun baru di LinkKerja.</h2>
    <p>Daftar sebagai pencari kerja untuk melamar, atau sebagai perekrut untuk memasang lowongan.</p>
@endsection
 
@section('konten')
    <form method="POST" action="{{ route('register') }}">
        @csrf
 
        <div class="field">
            <label>Daftar sebagai</label>
            <select name="role" onchange="document.getElementById('field-perusahaan').style.display = this.value === 'perekrut' ? 'block' : 'none'">
                <option value="pencari_kerja" {{ old('role', 'pencari_kerja') === 'pencari_kerja' ? 'selected' : '' }}>Pencari Kerja</option>
                <option value="perekrut" {{ old('role') === 'perekrut' ? 'selected' : '' }}>Perekrut</option>
            </select>
        </div>
 
        <div class="field"><label>Nama lengkap</label><input type="text" name="name" value="{{ old('name') }}" required></div>
 
        <div class="field" id="field-perusahaan" style="{{ old('role') === 'perekrut' ? '' : 'display:none;' }}">
            <label>Nama perusahaan</label>
            <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" placeholder="PT Teknologi Madiun">
        </div>
 
        <div class="field"><label>Email</label><input type="email" name="email" value="{{ old('email') }}" required></div>
        <div class="field"><label>Kata sandi</label><input type="password" name="password" placeholder="Minimal 8 karakter" required></div>
 
        <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Daftar Sekarang</button>
    </form>
@endsection