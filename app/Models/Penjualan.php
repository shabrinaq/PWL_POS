<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 't_penjualan'; // Nama tabel

    protected $primaryKey = 'penjualan_id'; // Primary key

    // Kolom yang bisa diisi
    protected $fillable = ['user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal'];

    public $timestamps = true;
}