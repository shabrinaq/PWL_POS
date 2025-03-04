<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // memaanipulasi tanggal dan waktu

class Penjualan_DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua penjualan yang ada
        $penjualan = DB::table('t_penjualan')->get();
        $barangIds = range(1, 10); // Asumsi ID 

        $data = [];

        foreach ($penjualan as $p) {
            for ($i = 0; $i < 3; $i++) {
                $data[] = [
                    'penjualan_id' => $p->penjualan_id,
                    'barang_id' => $barangIds[array_rand($barangIds)], // Pilih barang random
                    'harga' => rand(5000, 50000), // Harga random antara 5K - 50K
                    'jumlah' => rand(1, 5), // Jumlah barang 1-5
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}
