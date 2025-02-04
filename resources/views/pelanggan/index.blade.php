@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
    <h1>Data Pelanggan</h1>
    <a href="{{ route('pelanggan.create') }}">Tambah Pelanggan</a>
    <table>
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Nomor Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelanggans as $pelanggan)
                <tr>
                    <td>{{ $pelanggan->nama_pelanggan }}</td>
                    <td>{{ $pelanggan->alamat }}</td>
                    <td>{{ $pelanggan->nomor_telepon }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" style="display:inline;">
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