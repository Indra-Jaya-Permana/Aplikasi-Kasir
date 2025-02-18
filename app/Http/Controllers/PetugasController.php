<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    // Menampilkan daftar petugas
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();
        return view('petugas.list', compact('petugas'));
    }

    // Menampilkan form tambah petugas
    public function create()
    {
        return view('petugas.create');
    }

    // Menyimpan data petugas baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas', // Pastikan defaultnya petugas
        ]);

        return redirect()->route('petugas.list')->with('success', 'Petugas berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $petugas = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $petugas->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('petugas.list')->with('success', 'Petugas berhasil diperbarui!');
    }

    // Menghapus petugas
    public function destroy($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        return redirect()->route('petugas.list')->with('success', 'Petugas berhasil dihapus!');
    }
}

