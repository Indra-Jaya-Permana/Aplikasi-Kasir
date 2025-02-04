<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Produk;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Pelanggan::factory(10)->create();
        Produk::factory(10)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
