@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@section('content')
    <h1>Tambah Penjualan</h1>
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div>
            <label for="tanggal_penjualan">Tanggal Penjualan:</label>
            <input type="date" name="tanggal_penjualan" required>
        </div>
        <div>
            <label for="pelanggan_id">Pelanggan:</label>
            <select name="pelanggan_id" required>
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="total_harga">Total Harga:</label>
            <input type="number" name="total_harga" required>
        </div>
        <button type="submit">Simpan</button>
    </form>
@endsection