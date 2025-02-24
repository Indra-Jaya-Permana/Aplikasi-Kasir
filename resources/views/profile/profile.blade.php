<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f6ef; /* Sesuai color palette */
        }
        .navbar {
            background-color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            height: 40px;
        }
        .card-profile {
            background-color: #1e1e1e; /* Dark background */
            color: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 450px;
            margin: auto;
            margin-top: 60px;
        }
        .card-profile img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .table th {
            color: #e5c37f; /* Warna emas dari palette */
        }
        .btn-logout {
            background-color: #333;
            color: white;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
        }
        .btn-logout:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <!-- Profil Card -->
    <div class="card-profile text-center">
        <img src="{{ asset('upload/' . $user->profile_photo) }}" alt="Foto Profil">
        <h3>{{ $user->name }}</h3>
        <table class="table table-borderless text-white">
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
                <th>Tanggal Bergabung</th>
                <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
        </table>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>

</body>
</html>
