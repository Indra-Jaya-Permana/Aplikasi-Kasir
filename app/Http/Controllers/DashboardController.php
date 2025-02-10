<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\DetailPenjualan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total pelanggan
        $totalPelanggan = Pelanggan::count();

        // Mengambil jumlah total produk
        $totalProduk = Produk::count();

        // Mengambil jumlah total transaksi penjualan
        $totalPenjualan = Penjualan::count();

        // Menghitung total pendapatan hari ini
        $pendapatanHariIni = Penjualan::whereDate('created_at', Carbon::today())->sum('total_harga');

        // Mengambil 5 transaksi terbaru
        $transaksiTerbaru = Penjualan::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalPelanggan', 
            'totalProduk', 
            'totalPenjualan', 
            'pendapatanHariIni', 
            'transaksiTerbaru'
        ));
    }
}
