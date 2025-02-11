@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <h1>Edit Pelanggan</h1>
    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" name="nama_pelanggan" value="{{ $pelanggan->nama_pelanggan }}" required>
        </div>
        <div>
            <label for="alamat">Alamat:</label>
            <textarea name="alamat" required>{{ $pelanggan->alamat }}</textarea>
        </div>
        <div>
            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="text" name="nomor_telepon" value="{{ $pelanggan->nomor_telepon }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
