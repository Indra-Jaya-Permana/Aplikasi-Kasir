<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Produk;
use Database\Seeders\UserSeeder;
use Database\Seeders\PelangganSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Pelanggan::factory(10)->create();
        Produk::factory(10)->create();
        $this->call([
            PelangganSeeder::class,
            UserSeeder::class
        ]);
    }
}
