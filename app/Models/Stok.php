<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 't_stok'; // nama tabel di database
    protected $primaryKey = 'stok_id'; // primary key tabel
    
    // Kolom yang ada di tabel
    protected $fillable = ['barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah']; 
    public $timestamps = true; 
}
