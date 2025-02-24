@extends('layouts.app')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container">
    <h2>Tambah Petugas</h2>
    <form id="createForm" action="{{ route('petugas.store') }}" method="POST">
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
            <input type="password" name="password" id="password" class="form-control" required>
            <small id="passwordError" class="text-danger" style="display: none;">Password minimal 6 karakter!</small>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('petugas.list') }}" class="btn btn-secondary">Batal</a>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("createForm"); // Perbaiki ID form
        const passwordInput = document.getElementById("password");
        const passwordError = document.getElementById("passwordError");

        if (!form) {
            console.error("Form tidak ditemukan!");
            return;
        }

        form.addEventListener("submit", function (event) {
            let password = passwordInput.value;
            if (password.length < 6) {
                passwordError.style.display = "block"; // Tampilkan peringatan
                event.preventDefault(); // Cegah pengiriman form
            } else {
                passwordError.style.display = "none"; // Sembunyikan jika valid
            }
        });
    });
    </script>

</div>
@endsection
