@extends('layouts/app')

@section('title', 'Dashboard')

@section('content')
    <h1>DASHBOARD</h1>
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
    
    <h2>Transaksi Terbaru</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksiTerbaru as $key => $transaksi)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $transaksi->pelanggan->nama }}</td>
                <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                <td>{{ $transaksi->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
