@extends('layouts.app')

@section('title', 'Data Detail Penjualan')

@section('content')
    <h1>Data Detail Penjualan</h1>
    <a href="{{ route('detail-penjualan.create') }}">Tambah Detail Penjualan</a>
    <table>
        <thead>
            <tr>
                <th>Penjualan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailPenjualans as $detail)
                <tr>
                    <td>{{ $detail->penjualan->id }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->jumlah_produk }}</td>
                    <td>{{ $detail->subtotal }}</td>
                    <td>
                        <a href="{{ route('detail-penjualan.show', $detail->id) }}">Detail</a>
                        <form action="{{ route('detail-penjualan.destroy', $detail->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection