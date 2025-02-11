<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\Pelanggan;

class PenjualanSeeder extends Seeder
{
    public function run()
    {
        Penjualan::create([
            'tanggal_penjualan' => now(),
            'total_harga' => 50000,
            'pelanggan_id' => Pelanggan::inRandomOrder()->first()->id,
        ]);
    }
}
