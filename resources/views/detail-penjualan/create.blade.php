@extends('layouts.app')

@section('title', 'Tambah Detail Penjualan')

@section('content')
    <h1>Tambah Detail Penjualan</h1>
    <form action="{{ route('detail-penjualan.store') }}" method="POST ```blade
    @csrf
    <div>
        <label for="penjualan_id">Penjualan:</label>
        <select name="penjualan_id" required>
            <option value="">Pilih Penjualan</option>
            @foreach($penjualans as $penjualan)
                <option value="{{ $penjualan->id }}">{{ $penjualan->id }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="produk_id">Produk:</label>
        <select name="produk_id" required>
            <option value="">Pilih Produk</option>
            @foreach($produks as $produk)
                <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="jumlah_produk">Jumlah:</label>
        <input type="number" name="jumlah_produk" required>
    </div>
    <button type="submit">Simpan</button>
</form>
@endsection