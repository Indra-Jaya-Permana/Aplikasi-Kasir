<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Show a list of all penjualans
    public function index()
    {
        $penjualans = Penjualan::all();
        return view('penjualan.index', compact('penjualans'));
    }

    // Show form to create a new penjualan
    public function create()
    {
        $pelanggans = Pelanggan::all();
        $produks = Produk::all();
        return view('penjualan.create', compact('pelanggans', 'produks'));
    }

    // Store a new penjualan
    public function store(Request $request)
    {
        // Validate and store penjualan
        $validatedData = $request->validate([
            'tanggal_penjualan' => 'required|date',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
            'nama_pelanggan' => 'nullable|string',
            'total_harga' => 'required|numeric',
            'produk.*' => 'required|exists:produks,id',
            'jumlah_produk.*' => 'required|numeric',
        ]);

        $penjualanData = [
            'tanggal_penjualan' => $validatedData['tanggal_penjualan'],
            'total_harga' => $validatedData['total_harga'],
            'pelanggan_id' => $validatedData['pelanggan_id'] ?? null,
        ];

        $penjualan = Penjualan::create($penjualanData);

        // Save product details
        foreach ($validatedData['produk'] as $key => $produkId) {
            $penjualan->detailPenjualans()->create([
                'produk_id' => $produkId,
                'jumlah_produk' => $validatedData['jumlah_produk'][$key],
                'subtotal' => $validatedData['jumlah_produk'][$key] * Produk::find($produkId)->harga,
            ]);
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    // Show a specific penjualan
    public function show($id)
    {
        $penjualan = Penjualan::with('detailPenjualans')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

    // Add the destroy method to handle deletion of a penjualan
    public function destroy($id)
    {
        // Find the penjualan by ID
        $penjualan = Penjualan::findOrFail($id);

        // Delete the penjualan and associated detail penjualans
        $penjualan->delete();

        // Redirect back to the penjualan list with a success message
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}
