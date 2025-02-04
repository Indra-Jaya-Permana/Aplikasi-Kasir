@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <h1>Edit Produk</h1>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required>
        </div>
        <div>
            <label for="harga">Harga:</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" step="0.01" required>
        </div>
        <div>
            <label for="stok">Stok:</label>
            <input type="number" name="stok" value="{{ $produk->stok }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection