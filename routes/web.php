<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TransaksiStokController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/hello', function () {
    return 'Welcome';
});

// Menampilkan halaman index saat mengakses root /
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix'=>'kategori'],function(){
    Route::get('/',[KategoriController::class,'index'])->name('kategori.index');    // Menampilkan halaman utama kategori
    Route::post('/list',[KategoriController::class,'list'])->name('kategori.list'); // Mengambil data kategori dalam format DataTables
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);         // Menampilkan halaman form tambah kategori ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);                // Menyimpan data kategori baru ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);        // Menampilkan halaman form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);    // Menyimpan perubahan data kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);   // Untuk tampilkan form confirm  delete kategori Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk menghapus data kategori Ajax
});

Route::group(['prefix'=>'barang'],function(){
    Route::get('/',[BarangController::class,'index']);                            // Menampilkan halaman utama Barang
    Route::post('/list',[BarangController::class,'list']);                        // Mengambil data barang dalam format DataTables
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);         // Menampilkan halaman form tambah Barang ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax']);                // Menyimpan data Barang baru ajax
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);        // Menampilkan halaman form edit Barang Ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);    // Menyimpan perubahan data Barang Ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);   // Untuk tampilkan form confirm  delete Barang Ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk menghapus data Barang Ajax
});
 
Route::group(['prefix'=>'transaksi_stok'], function () {
    Route::get('/', [TransaksiStokController::class, 'index']);                          // Menampilkan halaman utama transaksi stok
    Route::post('/list', [TransaksiStokController::class, 'list']);                      // Mengambil data transaksi stok dalam format DataTables
    Route::get('/create_ajax', [TransaksiStokController::class, 'create_ajax']);         // Menampilkan halaman form tambah transaksi stok ajax
    Route::post('/ajax', [TransaksiStokController::class, 'store_ajax']);                // Menyimpan data transaksi stok baru ajax
    Route::get('/{id}/show_ajax', [TransaksiStokController::class, 'show_ajax']);        // Menampilkan detail transaksi stok
    Route::get('/{id}/edit_ajax', [TransaksiStokController::class, 'edit_ajax']);        // Menampilkan halaman form edit transaksi stok Ajax
    Route::put('/{id}/update_ajax', [TransaksiStokController::class, 'update_ajax']);    // Menyimpan perubahan data transaksi stok Ajax
    Route::get('/{id}/delete_ajax', [TransaksiStokController::class, 'confirm_ajax']);   // Untuk tampilkan form confirm  delete transaksi stok Ajax
    Route::delete('/{id}/delete_ajax', [TransaksiStokController::class, 'delete_ajax']); // Untuk menghapus data Transaksi stok Ajax
});

