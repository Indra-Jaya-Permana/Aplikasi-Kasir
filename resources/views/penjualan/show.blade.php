@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
    <h1>Detail Penjualan</h1>
    <p>Tanggal Penjualan: {{ $penjualan->tanggal_penjualan }}</p>
    <p>Total Harga: {{ $penjualan->total_harga }}</p>
    <p>Pelanggan: {{ $penjualan->pelanggan->nama_pelanggan }}</p>
    <h2>Detail Produk</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->detailPenjualans as $detail)
                <tr>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->jumlah_produk }}</td>
                    <td>{{ $detail->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection