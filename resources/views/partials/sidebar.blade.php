<!-- header (sidebar dan navigasi) -->
<aside class="sidebar">
    <div class="brand">
        <span class="brand-mark"></span>LinkKerja
    </div>

    <!-- Menu navigasi sesuai peran user -->
    @if (auth()->check() && auth()->user()->isPerekrut())
        <ul class="nav-list">
            <li><a class="{{ request()->routeIs('perekrut.dashboard') ? 'active' : '' }}" href="{{ route('perekrut.dashboard') }}">📊 Dasbor</a></li>
            <li><a class="{{ request()->routeIs('perekrut.lowongan.create') ? 'active' : '' }}" href="{{ route('perekrut.lowongan.create') }}">📝 Publikasi Lowongan</a></li>
            <li><a class="{{ request()->routeIs('perekrut.lowongan.*') && !request()->routeIs('perekrut.lowongan.create') ? 'active' : '' }}" href="{{ route('perekrut.lowongan.index') }}">💼 Manajemen Lowongan</a></li>
            <li><a class="{{ request()->routeIs('perekrut.kandidat.*') ? 'active' : '' }}" href="{{ route('perekrut.kandidat.index') }}">👥 Kandidat Masuk</a></li>
            <li><a class="{{ request()->routeIs('perekrut.profil') ? 'active' : '' }}" href="{{ route('perekrut.profil') }}">🏢 Profil Perusahaan</a></li>
        </ul>
        <div class="sidebar-footer">LinkKerja · UI Perekrut<br>{{ auth()->user()->perusahaan->nama_perusahaan ?? '' }}</div>
    @else
        <ul class="nav-list">
            <li><a class="{{ request()->routeIs('pencari.beranda') ? 'active' : '' }}" href="{{ route('pencari.beranda') }}">🏠 Beranda</a></li>
            <li><a class="{{ request()->routeIs('pencari.cari') || request()->routeIs('pencari.detail') ? 'active' : '' }}" href="{{ route('pencari.cari') }}">🔍 Cari Lowongan</a></li>
            <li><a class="{{ request()->routeIs('pencari.lamaran.*') ? 'active' : '' }}" href="{{ route('pencari.lamaran.index') }}">📄 Lamaran Saya</a></li>
            <li><a class="{{ request()->routeIs('pencari.profil') ? 'active' : '' }}" href="{{ route('pencari.profil') }}">🙍 Profil &amp; CV</a></li>
        </ul>
        <div class="sidebar-footer">LinkKerja · UI Pencari Kerja<br>{{ auth()->user()->name ?? '' }}</div>
    @endif
</aside>