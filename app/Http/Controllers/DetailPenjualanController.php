<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function create(Penjualan $penjualan)
    {
        $produks = Produk::all();
        return view('detail-penjualan.create', compact('penjualan', 'produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'produk_id' => 'required|exists:produks,id',
            'jumlah_produk' => 'required|integer|min:1'
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // Periksa apakah stok cukup
        if ($produk->stok < $request->jumlah_produk) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk produk ' . $produk->nama_produk);
        }

        $subtotal = $produk->harga * $request->jumlah_produk;

        // Simpan detail penjualan
        DetailPenjualan::create([
            'penjualan_id' => $request->penjualan_id,
            'produk_id' => $request->produk_id,
            'jumlah_produk' => $request->jumlah_produk,
            'subtotal' => $subtotal
            

        ]);

        // Kurangi stok produk
        $produk->kurangiStok($request->jumlah_produk);

        return redirect()->route('penjualan.show', $request->penjualan_id)->with('success', 'Detail Penjualan berhasil ditambahkan.');
    }
}