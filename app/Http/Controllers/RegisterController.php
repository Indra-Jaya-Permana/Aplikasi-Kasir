<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Pastikan file register.blade.php ada
    }

    public function register(Request $request)
    {
        // Debugging: Cek apakah data terkirim dengan benar
        // dd($request->all());

        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Pastikan password di-hash
            'role' => 'admin', // Set role otomatis jadi petugas
        ]);

        // Debugging: Cek apakah user berhasil dibuat
        if (!$user) {
            return redirect()->back()->with('error', 'Registrasi gagal. Silakan coba lagi.');
        }

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard setelah berhasil register
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
