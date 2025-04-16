<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan_Detail extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail'; // Nama tabel

    protected $primaryKey = 'detail_id'; // Primary key

    // Kolom yang bisa diisi
    protected $fillable = ['penjualan_id', 'barang_id', 'harga', 'jumlah'];

    public $timestamps = true;

    // Relasi dengan model Penjualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'penjualan_id');
    }

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }
}
