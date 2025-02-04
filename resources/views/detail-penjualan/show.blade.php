@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
    <h1>Detail Penjualan</h1>
    <p>Penjualan ID: {{ $detailPenjualan->penjualan_id }}</p>
    <p>Produk: {{ $detailPenjualan->produk->nama_produk }}</p>
    <p>Jumlah: {{ $detailPenjualan->jumlah_produk }}</p>
    <p>Subtotal: {{ $detailPenjualan->subtotal }}</p>
@endsection