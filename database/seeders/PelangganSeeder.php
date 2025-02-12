<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan; // Pastikan model Pelanggan digunakan

class PelangganSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel pelanggans.
     */
    public function run(): void
    {

        // Insert dummy data untuk mengisi ID pertama
    Pelanggan::create([
            'id'=> '1',
            'nama_pelanggan' => 'Pelanggan Umum',
            'alamat' => 'null',
            'nomor_telepon' => 'null'
    ]);
    }
}
