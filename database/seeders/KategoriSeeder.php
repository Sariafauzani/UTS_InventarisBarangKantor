<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['kategori_kode' => 'KTG001', 'kategori_nama' => 'Alat Tulis', 'created_at' => NOW()],
            ['kategori_kode' => 'KTG002', 'kategori_nama' => 'Kertas', 'created_at' => NOW()],
            ['kategori_kode' => 'KTG003', 'kategori_nama' => 'Map dan Arsip', 'created_at' => NOW()],
            ['kategori_kode' => 'KTG004', 'kategori_nama' => 'Peralatan Elektronik', 'created_at' => NOW()],
            ['kategori_kode' => 'KTG005', 'kategori_nama' => 'Tinta dan Refil', 'created_at' => NOW()],
        ]);
    }
}
