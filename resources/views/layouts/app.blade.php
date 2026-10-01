<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LinkKerja - @yield('judul', 'Dashboard')</title>
        <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    </head>
    <body>
        <div class="app-shell">
            <!-- memanggil file header -->
            @include('partials.header')

            <main class="main">
                <div class="top-bar">
                    <div>
                        <h1>@yield('judul', 'Dashboard')</h1>
                        <p>@yield('subjudul', '')</p>
                    </div>
                    @if(auth()->check())
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div class="user">
                            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                            <div>
                                <div style="font-weight: 600; font-size: 0.9rem;">{{ auth()->user()->name }}</div>
                                <div style="font-size:0.76rem; color:var(--ink-soft);">{{ auth()->user()->isPerekrut() ? 'Perekrut' : 'Pencari Kerja' }}</div>
                            </div>
                        </div>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="btn btn-outline">Keluar</button>
                        </form>
                    </div>
                    @endif
                </div>

                @if (session('sukses'))
                    <div class="card" style="border-color: #17b26a; margin-bottom:16px;">{{ session('sukses') }}</div>
                @endif

                <!-- tempat content -->
                @yield('konten')
            </main>
        </div>

        <!-- memanggil file footer -->
        @include('partials.footer')

        <script src="{{ asset('js/app.js')}}"></script>
    </body>
</html>