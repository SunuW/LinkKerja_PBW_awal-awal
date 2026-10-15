<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkKerja — @yield('judul', 'Dasbor')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
 
<div class="app-shell">
    @include('partials.sidebar')
 
    <main class="main">
        @include('partials.topbar')
 
        @if (session('sukses'))
            <div class="card" style="border-color:#17b26a; margin-bottom:16px;">{{ session('sukses') }}</div>
        @endif
        @if (session('gagal'))
            <div class="card" style="border-color:#e5484d; margin-bottom:16px;">{{ session('gagal') }}</div>
        @endif
        @if ($errors->any())
            <div class="card" style="border-color:#e5484d; margin-bottom:16px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        @yield('konten')
    </main>
</div>
 
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
