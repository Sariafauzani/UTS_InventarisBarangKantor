<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_stok', function (Blueprint $table) {
            $table->id('transaksi_stok_id');
            $table->unsignedBigInteger('barang_id')->index();
            $table->enum('type', ['masuk', 'keluar']);  // Jenis transaksi: masuk atau keluar
            $table->integer('quantity');  // Jumlah barang yang masuk/keluar
            $table->text('keterangan')->nullable();  // Catatan transaksi
            $table->timestamps();

            // Foreign key Constraints
            $table->foreign('barang_id')->references('barang_id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_stok');
    }
};
