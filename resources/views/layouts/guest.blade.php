<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkKerja — @yield('judul', 'Masuk')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
 
<section class="auth-wrap">
    <div class="auth-hero">
        <div class="brand" style="font-size:1.4rem;"><span class="brand-mark" style="background:#fff;"></span>LinkKerja</div>
        @yield('hero')
    </div>
    <div class="auth-form-wrap">
        <div class="auth-card">
            <div class="role-toggle">
                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}" style="text-align:center; text-decoration:none;">Masuk</a>
                <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}" style="text-align:center; text-decoration:none;">Daftar</a>
            </div>
 
            @if ($errors->any())
                <div class="card" style="border-color:#e5484d; margin-bottom:14px;">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
 
            @yield('konten')
        </div>
    </div>
</section>
 
</body>
</html>