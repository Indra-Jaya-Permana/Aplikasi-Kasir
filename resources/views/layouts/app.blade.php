
@section('title', 'Dashboard')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">
        @stack('styles')
    </head>
<body>
    @if (!in_array(Route::currentRouteName(), ['login', 'register.form']))
    <nav class="nav">
        <img src="{{ asset('image/cashh.png') }}" alt="Logo" class="logo">
        <ul>
            <li><a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('pelanggan.index') }}" class="{{ Request::routeIs('pelanggan.index') ? 'active' : '' }}">Pelanggan</a></li>
            <li><a href="{{ route('produk.index') }}" class="{{ Request::routeIs('produk.index') ? 'active' : '' }}">Produk</a></li>
            <li><a href="{{ route('penjualan.index') }}" class="{{ Request::routeIs('penjualan.index') ? 'active' : '' }}">Penjualan</a></li>
            <li><a href="{{ route('user.detail', Auth::user()->id) }}" class="{{ Request::routeIs('user.detail') ? 'active' : '' }}">Profil</a></li> 
    
            @if (Auth::user() && Auth::user()->role === 'admin')
                <li><a href="{{ route('petugas.list') }}" class="{{ Request::routeIs('petugas.list') ? 'active' : '' }}">Kelola Pengguna</a></li>
            @endif  
        </ul>
    </nav>
    
    
    @endif
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
