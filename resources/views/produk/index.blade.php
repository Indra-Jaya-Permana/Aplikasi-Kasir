@extends('layouts.app')

@section('title', 'Data Produk')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('content')
    <h1>Data Produk</h1>
    <li>
        <form action="{{ route('produk.create') }}" method="GET">
            @csrf
            <button type="submit">Tambah Produk</button>
        </form>
    </li>

    <form action="{{ route('produk.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    <table>
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produks as $produk)
        <tr>
            <td>
                @if($produk->foto)
                    <img src="{{ asset('storage/' . $produk->foto) }}" width="100">
                @else
                    Tidak ada foto
                @endif
            </td>
            <td>{{ $produk->nama_produk }}</td>
            <td>{{ $produk->harga }}</td>
            <td>{{ $produk->stok }}</td>
            <td class="icon-wrapper">
                <a href="{{ route('produk.edit', $produk->id) }}">
                    <img class="icon" src="{{ asset('image/icons8-edit-50.png') }}" alt="Edit">
                </a>
                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn">
                        <img class="icon" src="{{ asset('image/delete.png') }}" alt="Hapus">
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection