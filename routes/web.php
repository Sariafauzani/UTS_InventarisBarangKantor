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

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix'=>'kategori'],function(){
    Route::get('/',[KategoriController::class,'index'])->name('kategori.index');
    Route::post('/list',[KategoriController::class,'list'])->name('kategori.list');
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // menampilkan halaman form tambah kategori ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);        // menyimpan data kategori baru ajax
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); // menampilkan halaman form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);  // menyimpan perubahan data kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // untuk tampilkan form confirm  delete kategori Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // untuk menghapus data kategori Ajax
    Route::delete('/{id}',[KategoriController::class,'destroy']);
});

Route::group(['prefix'=>'barang'],function(){
    Route::get('/',[BarangController::class,'index']);
    Route::post('/list',[BarangController::class,'list']);
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // menampilkan halaman form tambah Barang ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax']);        // menyimpan data Barang baru ajax
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); // menampilkan halaman form edit Barang Ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);  // menyimpan perubahan data Barang Ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // untuk tampilkan form confirm  delete Barang Ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // untuk menghapus data Barang Ajax
    Route::delete('/{id}',[BarangController::class,'destroy']);
});
 
Route::group(['prefix'=>'transaksi_stok'], function () {
    Route::get('/', [TransaksiStokController::class, 'index']);
    Route::post('/list', [TransaksiStokController::class, 'list']);

    // === Route static tanpa parameter ===
    Route::get('/create_ajax', [TransaksiStokController::class, 'create_ajax']);
    Route::post('/ajax', [TransaksiStokController::class, 'store_ajax']);

    // === Route dynamic {id} ===
    Route::get('/{id}/edit_ajax', [TransaksiStokController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [TransaksiStokController::class, 'update_ajax']);
    
    Route::get('/{id}/delete_ajax', [TransaksiStokController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [TransaksiStokController::class, 'delete_ajax']);
});

