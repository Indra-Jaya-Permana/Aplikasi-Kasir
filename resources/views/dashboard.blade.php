<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div>
    <h1>Dashboard</h1>
    <div>
        <div>
            <div>
                <div>Total Pelanggan</div>
                <div>
                    <h4>{{ $totalPelanggan }}</h4>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>Total Produk</div>
                <div>
                    <h4>{{ $totalProduk }}</h4>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>Total Penjualan</div>
                <div>
                    <h4>{{ $totalPenjualan }}</h4>
                </div>
            </div>
        </div>
        <div>
            <div>
                <div>Pendapatan Hari Ini</div>
                <div>
                    <h4>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div>Riwayat Transaksi Terbaru</div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksiTerbaru as $transaksi)
                    <tr>
                        <td>{{ $transaksi->id }}</td>
                        <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                        <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td><a href="{{ route('penjualan.show', $transaksi->id) }}">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection