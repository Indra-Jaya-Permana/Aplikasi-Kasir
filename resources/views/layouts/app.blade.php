<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @if (!in_array(Route::currentRouteName(), ['login', 'register.form']))
    <nav>
        <ul>
            if role admin
            <li><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li><a href="{{ route('produk.index') }}">Produk</a></li>
            <li><a href="{{ route('penjualan.index') }}">Penjualan</a></li>
            else
            <li><a href="{{ route('pelanggan-biasa.index') }}">Pelanggan</a></li>
            <li><a href="{{ route('produk.index') }}">Produk</a></li>
            <li><a href="{{ route('penjualan.index') }}">Penjualan</a></li>
            <li><a href="{{ route('user.detail', Auth::user()->id) }}">Profil</a></li> <!-- Menambahkan link Profil -->
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    @endif
    
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
