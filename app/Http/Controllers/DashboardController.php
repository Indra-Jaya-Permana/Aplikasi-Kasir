<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalPelanggan' => 0, // Ganti dengan data asli
            'totalProduk' => 0, // Ganti dengan data asli
            'totalPenjualan' => 0, // Ganti dengan data asli
            'pendapatanHariIni' => 0, // Ganti dengan data asli
            'transaksiTerbaru' => [], // Ganti dengan data asli
        ]);
    }
}
