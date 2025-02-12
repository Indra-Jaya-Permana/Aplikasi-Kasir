@extends('layouts.app')

@section('title', 'Data Penjualan')

@section('content')
    <h1>Data Penjualan</h1>
    <a href="{{ route('penjualan.create') }}">Tambah Penjualan</a>
    <table>
        <thead>
            <tr>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>Pelanggan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
    @foreach($penjualans as $penjualan)
        <tr>
            <td>{{ $penjualan->tanggal_penjualan }}</td>
            <td>{{ $penjualan->total_harga }}</td>
            <td>
                @if($penjualan->pelanggan_id)
                    {{ $penjualan->pelanggan->nama_pelanggan }}
                @else
                    {{ $penjualan->bukan_member }}
                @endif
            </td>
            <td>
                <a href="{{ route('penjualan.show', $penjualan->id) }}">Detail</a>
                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" style="display:inline;">
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