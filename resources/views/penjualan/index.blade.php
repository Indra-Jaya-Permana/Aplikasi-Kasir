@extends('layouts.app')

@section('title', 'Data Penjualan')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('content')
    <h1>Data Penjualan</h1>
    <li>
        <form action="{{ route('penjualan.create') }}" method="GET">
            @csrf
            <button type="submit">Tambah Penjualan</button>
        </form>
    </li>

    <form action="{{ route('penjualan.index') }}" method="GET">
    <input type="date" name="search" value="{{ request('search') }}">
    <button type="submit">Cari</button>
</form>

@if($penjualans->isEmpty())
    <p>Data tidak ditemukan.</p>
@else

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
    @endif
@endsection