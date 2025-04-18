<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            // Alat Tulis - KTG001
            [
                'barang_nama' => 'Pulpen Biru',
                'barang_kode' => 'KTG001-001',
                'kategori_id' => 1,
                'unit' => 'pcs',
                'stok_barang' => 100,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Pensil 2B',
                'barang_kode' => 'KTG001-002',
                'kategori_id' => 1,
                'unit' => 'pcs',
                'stok_barang' => 150,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Spidol Permanent',
                'barang_kode' => 'KTG001-003',
                'kategori_id' => 1,
                'unit' => 'pcs',
                'stok_barang' => 80,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Penghapus',
                'barang_kode' => 'KTG001-004',
                'kategori_id' => 1,
                'unit' => 'pcs',
                'stok_barang' => 60,
                'created_at' => now(),
            ],

            // Kertas - KTG002
            [
                'barang_nama' => 'Kertas A4 70gr',
                'barang_kode' => 'KTG002-001',
                'kategori_id' => 2,
                'unit' => 'rim',
                'stok_barang' => 40,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Kertas F4 80gr',
                'barang_kode' => 'KTG002-002',
                'kategori_id' => 2,
                'unit' => 'rim',
                'stok_barang' => 35,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'HVS A3',
                'barang_kode' => 'KTG002-003',
                'kategori_id' => 2,
                'unit' => 'pack',
                'stok_barang' => 25,
                'created_at' => now(),
            ],

            // Map dan Arsip - KTG003
            [
                'barang_nama' => 'Map Snelhecter',
                'barang_kode' => 'KTG003-001',
                'kategori_id' => 3,
                'unit' => 'pcs',
                'stok_barang' => 90,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Ordner A4',
                'barang_kode' => 'KTG003-002',
                'kategori_id' => 3,
                'unit' => 'pcs',
                'stok_barang' => 45,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Stopmap Kertas',
                'barang_kode' => 'KTG003-003',
                'kategori_id' => 3,
                'unit' => 'pcs',
                'stok_barang' => 70,
                'created_at' => now(),
            ],

            // Peralatan Elektronik - KTG004
            [
                'barang_nama' => 'Printer Inkjet',
                'barang_kode' => 'KTG004-001',
                'kategori_id' => 4,
                'unit' => 'unit',
                'stok_barang' => 5,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Kalkulator',
                'barang_kode' => 'KTG004-002',
                'kategori_id' => 4,
                'unit' => 'pcs',
                'stok_barang' => 10,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Scanner Dokumen',
                'barang_kode' => 'KTG004-003',
                'kategori_id' => 4,
                'unit' => 'unit',
                'stok_barang' => 3,
                'created_at' => now(),
            ],

            // Tinta dan Refil - KTG005
            [
                'barang_nama' => 'Tinta Printer Hitam',
                'barang_kode' => 'KTG005-001',
                'kategori_id' => 5,
                'unit' => 'botol',
                'stok_barang' => 20,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Tinta Warna Cyan',
                'barang_kode' => 'KTG005-002',
                'kategori_id' => 5,
                'unit' => 'botol',
                'stok_barang' => 15,
                'created_at' => now(),
            ],
            [
                'barang_nama' => 'Refil Spidol',
                'barang_kode' => 'KTG005-003',
                'kategori_id' => 5,
                'unit' => 'ml',
                'stok_barang' => 100,
                'created_at' => now(),
            ],
        ]);
    }
}