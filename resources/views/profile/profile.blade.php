@extends('layouts/app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Profil Pengguna</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('upload/' . $user->profile_photo) }}" alt="Foto Profil" class="rounded-circle" width="150">
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>ID Petugas</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ ucfirst($user->role) }}</td>
                    </tr>
                    <tr>
                        <th>Username & Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Hak Akses</th>
                        <td>{{ $user->role == 'admin' ? 'Mengelola sistem' : 'Mencatat transaksi' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Bergabung</th>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status Keaktifan</th>
                        <td>
                            @if($user->role == 'petugas')
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Inaktif' }}
                                </span>
                            @else
                                <span class="badge bg-secondary">N/A</span>
                            @endif
                        </td>
                    </tr>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit Profil</a>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                </table>
            </div>
        </div>
    </div>
</body>
</html>