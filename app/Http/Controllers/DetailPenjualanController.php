<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $details = DetailPenjualan::all();
        return view('detail-penjualan.index', compact('details'));
    }

    public function create()
    {
        return view('detail-penjualan.create');
    }
}
