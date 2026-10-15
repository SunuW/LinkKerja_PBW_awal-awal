<aside class="sidebar">
    <div class="brand"><span class="brand-mark"></span>LinkKerja</div>
 
    @if (auth()->user()->isPerekrut())
        <ul class="nav-list">
            <li><a class="{{ request()->routeIs('perekrut.profil') ? 'active' : '' }}" href="{{ route('perekrut.profil') }}">🏢 Profil Perusahaan</a></li>
        </ul>
        <div class="sidebar-footer">LinkKerja · Perekrut<br>{{ auth()->user()->perusahaan->nama_perusahaan }}</div>
    @else
        <ul class="nav-list">
            <li><a class="{{ request()->routeIs('pencari.beranda') ? 'active' : '' }}" href="{{ route('pencari.beranda') }}">🏠 Beranda</a></li>
            <li><a class="{{ request()->routeIs('pencari.cari') || request()->routeIs('pencari.detail') ? 'active' : '' }}" href="{{ route('pencari.cari') }}">🔍 Cari Lowongan</a></li>
            <li><a class="{{ request()->routeIs('pencari.profil') ? 'active' : '' }}" href="{{ route('pencari.profil') }}">🙍 Profil &amp; Dokumen</a></li>
        </ul>
        <div class="sidebar-footer">LinkKerja · Pencari Kerja<br>{{ auth()->user()->name }}</div>
    @endif
</aside>
