<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // import DB

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'ELEK001',
                'barang_nama' => 'Laptop ASUS',
                'harga_beli' => 7000000,
                'harga_jual' => 8000000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'ELEK002',
                'barang_nama' => 'Smartphone Samsung',
                'harga_beli' => 5000000,
                'harga_jual' => 5500000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'PERA001',
                'barang_nama' => 'Meja Kayu',
                'harga_beli' => 1500000,
                'harga_jual' => 1800000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'PERA002',
                'barang_nama' => 'Kursi Kantor',
                'harga_beli' => 750000,
                'harga_jual' => 900000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'PAKA001',
                'barang_nama' => 'Kaos Polos',
                'harga_beli' => 50000,
                'harga_jual' => 70000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'PAKA002',
                'barang_nama' => 'Jaket Hoodie',
                'harga_beli' => 200000,
                'harga_jual' => 250000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'MAKA001',
                'barang_nama' => 'Mie Instan',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'MAKA002',
                'barang_nama' => 'Biskuit Coklat',
                'harga_beli' => 5000,
                'harga_jual' => 7000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'MINU001',
                'barang_nama' => 'Air Mineral 600ml',
                'harga_beli' => 3000,
                'harga_jual' => 5000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'MINU002',
                'barang_nama' => 'Kopi Instan',
                'harga_beli' => 1500,
                'harga_jual' => 2000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
