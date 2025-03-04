<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'm_kategori'; // nama tabel 

    protected $primaryKey = 'kategori_id'; // PrimaryKey

    protected $fillable = ['kategori_kode', 'kategori_nama']; // kolom yang ada di kategori

    public $timestamps = true; 
}
