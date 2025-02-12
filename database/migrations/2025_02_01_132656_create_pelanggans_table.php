<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->text('alamat');
            $table->string('nomor_telepon', 20);
            $table->timestamps();
        });

        // Set ID mulai dari 2, tapi hanya jika database adalah MySQL
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE pelanggans AUTO_INCREMENT = 2;');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
