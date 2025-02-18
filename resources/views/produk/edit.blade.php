@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1>Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required>
    </div>

    <div>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" value="{{ $produk->harga }}" required>
    </div>

    <div>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" value="{{ $produk->stok }}" required>
    </div>

    <div>
        <label for="foto">Foto Produk:</label>
        <input type="file" name="foto" accept="image/*">
        @if($produk->foto)
            <img src="{{ asset('storage/' . $produk->foto) }}" width="100">
        @endif
    </div>

    <button type="submit">Simpan</button>
</form>

@endsection