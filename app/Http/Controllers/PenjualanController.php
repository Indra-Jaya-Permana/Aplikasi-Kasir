<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\DetailPenjualan; // Pastikan ini ada
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Show a list of all penjualans
    public function index(Request $request)
    {
        $query = Penjualan::query();

        if ($request->has('search')) {
            $query->whereDate('tanggal_penjualan', $request->search);
        }

        $penjualans = $query->with('pelanggan')->get();
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
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'total_harga' => 'required|numeric',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
            'nama_pelanggan' => 'nullable|string',
            'produk' => 'required|array',
            'jumlah_produk' => 'required|array',
        ]);

        $penjualan = new Penjualan();
        $penjualan->tanggal_penjualan = $request->tanggal_penjualan;
        $penjualan->total_harga = $request->total_harga;

        if (!empty($request->pelanggan_id) && $request->pelanggan_id !== "non-member") {
            $penjualan->pelanggan_id = $request->pelanggan_id;
        } else {
            $penjualan->pelanggan_id = null;
        }

        $penjualan->save();

        // Simpan detail penjualan untuk setiap produk
        foreach ($request->produk as $index => $produkId) {
            $jumlah = $request->jumlah_produk[$index];

            // Ambil produk
            $produk = Produk::findOrFail($produkId);

            // Periksa apakah stok cukup
            if ($produk->stok < $jumlah) {
                return redirect()->back()->with('error', 'Stok tidak cukup untuk produk ' . $produk->nama_produk);
            }

            // Simpan detail penjualan
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $produkId,
                'jumlah_produk' => $jumlah,
                'subtotal' => $produk->harga * $jumlah
            ]);

            // Kurangi stok produk
            $produk->kurangiStok($jumlah);
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