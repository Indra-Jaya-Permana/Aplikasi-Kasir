@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
    <h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" required>
        </div>
        <div>
            <label for="harga">Harga:</label>
            <input type="number" name="harga" step="0.01" required>
        </div>
        <div>
            <label for="stok">Stok:</label>
            <input type="number" name="stok" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection