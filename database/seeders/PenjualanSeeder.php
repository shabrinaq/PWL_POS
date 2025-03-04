<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // import DB
use Carbon\Carbon; // memaanipulasi tanggal dan waktu

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'pembeli' => 'Ahmad Febrian',
                'penjualan_kode' => 'PNK001',
                'penjualan_tanggal' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Arya Mohan',
                'penjualan_kode' => 'PNK002',
                'penjualan_tanggal' => Carbon::now()->subDays(1),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Syakira Selfiana',
                'penjualan_kode' => 'PNK003',
                'penjualan_tanggal' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 1, 
                'pembeli' => 'Ananda Veronica',
                'penjualan_kode' => 'PNK004',
                'penjualan_tanggal' => Carbon::now()->subDays(3),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Fattah Syach',
                'penjualan_kode' => 'PNK005',
                'penjualan_tanggal' => Carbon::now()->subDays(4),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Fajar Pratama',
                'penjualan_kode' => 'PNK006',
                'penjualan_tanggal' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Raisya Oktavia',
                'penjualan_kode' => 'PNK007',
                'penjualan_tanggal' => Carbon::now()->subDays(6),
            ],
            [
                'user_id' => 2,
                'pembeli' => 'Habibi Muhammad',
                'penjualan_kode' => 'PNK008',
                'penjualan_tanggal' => Carbon::now()->subDays(7),
            ],
            [
                'user_id' => 3,
                'pembeli' => 'Indah Permata',
                'penjualan_kode' => 'PNK009',
                'penjualan_tanggal' => Carbon::now()->subDays(8),
            ],
            [
                'user_id' => 1,
                'pembeli' => 'Naila Fardausia',
                'penjualan_kode' => 'PNK010',
                'penjualan_tanggal' => Carbon::now()->subDays(9),
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
