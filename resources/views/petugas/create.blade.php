@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container">
    <h2>Tambah Petugas</h2>
    <form action="{{ route('petugas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('petugas.list') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
