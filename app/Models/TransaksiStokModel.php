<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiStokModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_stok';
    protected $primaryKey = 'transaksi_stok_id';
    public $timestamps = true;

    protected $fillable = [
        'barang_id',
        'type',         // 'masuk' atau 'keluar'
        'quantity',     // jumlah barang
        'keterangan'    // catatan opsional
    ];

    // Relasi ke model Barang
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }
}
