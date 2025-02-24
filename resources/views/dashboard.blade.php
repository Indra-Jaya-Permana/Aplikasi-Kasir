@extends('layouts/app')
@section('title', 'Dashboard')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('content')
    <h2>WELCOME TO CASHERE</h2>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Pelanggan</h5>
                    <p>{{ $totalPelanggan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Produk</h5>
                    <p>{{ $totalProduk }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Penjualan</h5>
                    <p>{{ $totalPenjualan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Pendapatan Hari Ini</h5>
                    <p>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    
  <h2>TRANSAKSI TERBARU</h2>
<div class="table-container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksiTerbaru as $key => $transaksi)
            <tr>
                <td>{{ $key + 1 }}</td> <!-- Nama Pelanggan -->
                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td> <!-- Total Harga -->
                <td>{{ $transaksi->created_at->format('d M Y') }}</td> <!-- Tanggal -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
