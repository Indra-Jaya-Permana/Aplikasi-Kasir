<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penjualan');
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->foreignId('pelanggan_id')->constrained('pelanggans')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }


};