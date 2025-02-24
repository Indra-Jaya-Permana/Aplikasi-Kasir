@extends('layouts.app')

@section('title', 'Data Pelanggan')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
@section('content')
    <h1>Data Pelanggan</h1>
    <li>
        <form action="{{ route('pelanggan.create') }}" method="GET">
            @csrf
            <button type="submit">Tambah Pelanggan</button>
        </form>
    </li>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

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
                    <td class="icon-wrapperpelanggan">
                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}">
                            <img class="icon" src="{{ asset('image/icons8-edit-50.png') }}" alt="Edit">
                        </a>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="icon-btn">
                                <img class="icon" src="{{ asset('image/delete.png') }}" alt="Hapus">
                            </button>
                        </form>
                    </td>                                 
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
