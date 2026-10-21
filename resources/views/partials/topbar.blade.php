<div class="topbar">
    <div>
        <h1>@yield('judul', 'Dasbor')</h1>
        <p>@yield('subjudul', '')</p>
    </div>
    <div style="display:flex; align-items:center; gap:12px;">
        <div class="user-chip">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div style="font-weight:600; font-size:0.9rem;">{{ auth()->user()->name }}</div>
                <div style="font-size:0.76rem; color:var(--ink-soft);">{{ auth()->user()->isPerekrut() ? 'Perekrut' : 'Pencari Kerja' }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline">Keluar</button>
        </form>
    </div>
</div>
