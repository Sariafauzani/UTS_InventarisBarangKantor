<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Transaksi_StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi_stok')->insert([
            // Transaksi Masuk
            [
                'barang_id' => 1,  // Pulpen Biru
                'type' => 'masuk',
                'quantity' => 50,
                'keterangan' => 'Stok baru dari supplier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 2,  // Pensil 2B
                'type' => 'masuk',
                'quantity' => 100,
                'keterangan' => 'Stok baru untuk kebutuhan kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 5,  // Kertas A4 70gr
                'type' => 'masuk',
                'quantity' => 200,
                'keterangan' => 'Pengadaan untuk proyek kantor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 8,  // Map Snelhecter
                'type' => 'masuk',
                'quantity' => 50,
                'keterangan' => 'Pengadaan map untuk arsip',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 11, // Printer Inkjet
                'type' => 'masuk',
                'quantity' => 5,
                'keterangan' => 'Printer baru untuk departemen IT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 14, // Tinta Printer Hitam
                'type' => 'masuk',
                'quantity' => 30,
                'keterangan' => 'Tinta untuk refill printer',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Transaksi Keluar
            [
                'barang_id' => 3,  // Spidol Permanent
                'type' => 'keluar',
                'quantity' => 20,
                'keterangan' => 'Dipinjam oleh staff untuk presentasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 6,  // Kertas F4 80gr
                'type' => 'keluar',
                'quantity' => 50,
                'keterangan' => 'Digunakan untuk rapat internal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 9,  // Ordner A4
                'type' => 'keluar',
                'quantity' => 10,
                'keterangan' => 'Dipinjam untuk penyimpanan dokumen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 12, // Kalkulator
                'type' => 'keluar',
                'quantity' => 2,
                'keterangan' => 'Dipinjam oleh staf keuangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'barang_id' => 15, // Refil Spidol
                'type' => 'keluar',
                'quantity' => 100,
                'keterangan' => 'Distribusi ke beberapa departemen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}