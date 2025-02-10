<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::all();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        return view('penjualan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'total' => 'required|numeric',
        ]);

        Penjualan::create($validatedData);
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }
}
