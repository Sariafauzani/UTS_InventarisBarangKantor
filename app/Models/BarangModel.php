<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
  
    class BarangModel extends Model{
        protected $table = 'barang';         // nama tabel di database
        protected $primaryKey = 'barang_id'; // nama kolom primary key dari tabel barang
     
        protected $fillable = ['barang_kode', 'barang_nama', 'kategori_id', 'unit', 'stok_barang'];
     
        // Menyatakan bahwa setiap barang "dimiliki oleh satu" kategori
        public function kategori(): BelongsTo {
            return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id'); // 'kategori_id': foreign key di tabel barang dan kategori
        }
    }