<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pelanggan')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('penjualan.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'pelanggan_id' => 'required|exists:pelanggans,id'
        ]);

        Penjualan::create($request->all());
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function edit(Penjualan $penjualan)
    {
        $pelanggans = Pelanggan::all();
        return view('penjualan.edit', compact('penjualan', 'pelanggans'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'pelanggan_id' => 'required|exists:pelanggans,id'
        ]);

        $penjualan->update($request->all());
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }

    public function show($id)
    {
        $penjualan = Penjualan::with('detailPenjualans.produk', 'pelanggan')->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }
}
