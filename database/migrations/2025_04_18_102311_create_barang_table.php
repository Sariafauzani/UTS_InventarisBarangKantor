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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->string('barang_nama', 100);
            $table->string('barang_kode')->unique();  // Kode unik barang
            $table->unsignedBigInteger('kategori_id')->index();
            $table->string('unit');  // Satuan barang, misal: pcs, rim
            $table->integer('stok_barang')->default(0);  // Stok barang
            $table->timestamps();

            // Foreign key Constraints
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
