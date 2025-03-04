<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // import DB

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1, // Laptop ASUS
                'user_id' => 1, // User yang menginput stok
                'stok_tanggal' => now(),
                'stok_jumlah' => 25, // Stok awal
            ],
            [
                'barang_id' => 2, // Smartphone Samsung
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 30,
            ],
            [
                'barang_id' => 3, // Meja Kayu
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 12,
            ],
            [
                'barang_id' => 4, // Kursi Kantor
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 10,
            ],
            [
                'barang_id' => 5, // Kaos Polos
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 50,
            ],
            [
                'barang_id' => 6, // Jaket Hoodie
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 20,
            ],
            [
                'barang_id' => 7, // Mie Instan
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 100,
            ],
            [
                'barang_id' => 8, // Biskuit Coklat
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 40,
            ],
            [
                'barang_id' => 9, // Air Mineral 600ml
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 180,
            ],
            [
                'barang_id' => 10, // Kopi Instan
                'user_id' => 1,
                'stok_tanggal' => now(),
                'stok_jumlah' => 150,
            ],
        ];

        // Insert data ke dalam tabel `t_stok`
        DB::table('t_stok')->insert($data);
    }
}
