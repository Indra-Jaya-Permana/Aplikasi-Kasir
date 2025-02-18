@extends('layouts.app')

@section('title', 'Daftar Petugas')

@section('content')
<div class="container">
    <h2>Daftar Petugas</h2>
    <a href="{{ route('petugas.create') }}" class="btn btn-primary mb-3">Tambah Petugas</a> <!-- Tombol Tambah -->
    
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($petugas as $key => $p)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>
                    <a href="{{ route('petugas.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('petugas.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
