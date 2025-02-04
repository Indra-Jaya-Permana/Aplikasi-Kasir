<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan; // Pastikan model Pelanggan sudah ada
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all(); // Ambil semua data pelanggan
        return view('pelanggan.index', compact('pelanggans')); // Tampilkan view dengan data pelanggan
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create'); // Tampilkan form untuk membuat pelanggan baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggans',
            // Tambahkan aturan validasi lain jika diperlukan
        ]);

        Pelanggan::create($validatedData); // Simpan data pelanggan baru ke database
        return redirect()->route('pelanggan.index')->with('success', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id); // Ambil pelanggan berdasarkan ID
        return view('pelanggan.show', compact('pelanggan')); // Tampilkan detail pelanggan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id); // Ambil pelanggan berdasarkan ID
        return view('pelanggan.edit', compact('pelanggan')); // Tampilkan form edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id); // Ambil pelanggan berdasarkan ID

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggans,email,' . $pelanggan->id,
            // Tambahkan aturan validasi lain jika diperlukan
        ]);

        $pelanggan->update($validatedData); // Perbarui data pelanggan
        return redirect()->route('pelanggan.index')->with('success', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id); // Ambil pelanggan berdasarkan ID
        $pelanggan->delete(); // Hapus pelanggan
        return redirect()->route('pelanggan.index')->with('success', 'Customer deleted successfully!');
    }
}