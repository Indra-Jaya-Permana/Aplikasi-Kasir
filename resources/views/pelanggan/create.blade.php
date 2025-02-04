@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <h1>Tambah Pelanggan</h1>
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" name="nama_pelanggan" required>
        </div>
        <div>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required></textarea>
        </div>
        <div>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection