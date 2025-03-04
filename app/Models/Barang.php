<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; // nama tabel 

    protected $primaryKey = 'barang_id'; // primary key

    // kolom yang ada di barang
    protected $fillable = ['kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual']; 

    public $timestamps = true; 
}