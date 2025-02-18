@extends('layouts.app')

@section('title', 'Edit Petugas')

@section('content')
<div class="container">
    <h2>Edit Petugas</h2>
    <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $petugas->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $petugas->email }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('petugas.list') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
