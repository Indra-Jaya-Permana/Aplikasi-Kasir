@extends('layouts.app')

@section('title', 'Tambah Produk')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('content')
    <h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" required>
    </div>
    
    <div>
        <label for="harga">Harga:</label>
        <input type="number" name="harga" required>
    </div>
    
    <div>
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required>
    </div>

    <div>
        <label for="foto">Foto Produk:</label>
        <input type="file" name="foto" accept="image/*">
    </div>

    <button type="submit">Simpan</button>
    </form>

@endsection