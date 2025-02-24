<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning text-black">
                <h3>Edit Profil</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="profile_photo" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                        @if($user->profile_photo)
                            <img src="{{ asset('upload/' . $user->profile_photo) }}" alt="Foto Profil" class="mt-3 rounded-circle" width="100">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('user.detail', $user->id) }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
