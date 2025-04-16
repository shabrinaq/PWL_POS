<?php


use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);  // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);  // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);  // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);  // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);  // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);  // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilan form confirm_delete user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // untuk menghapusdata user ajax
    Route::get('/user/{id}/show_ajax', [UserController::class, 'show_ajax']); // untuk menampilkan detailnya
    Route::delete('/{id}', [UserController::class, 'destroy']);  // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index'])->name('index');
    Route::get('/create', [LevelController::class, 'create']);
    Route::post('/', [LevelController::class, 'store']);
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::delete('/{id}', [LevelController::class, 'delete']);
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index');
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}', [KategoriController::class, 'delete']);
});

Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index'); // Menampilkan daftar barang
    Route::get('create', [BarangController::class, 'create'])->name('barang.create'); // Menampilkan form tambah barang
    Route::post('store', [BarangController::class, 'store'])->name('barang.store'); // Menyimpan barang baru
    Route::get('{id}', [BarangController::class, 'show'])->name('barang.show'); // Menampilkan detail barang
    Route::get('{id}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Menampilkan form edit barang
    Route::put('{id}', [BarangController::class, 'update'])->name('barang.update'); // Update data barang
    Route::delete('{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Hapus barang
});

Route::prefix('stok')->group(function () {
    Route::get('/', [StokController::class, 'index'])->name('stok.index'); // Menampilkan daftar stok
    Route::get('create', [StokController::class, 'create'])->name('stok.create'); // Menampilkan form tambah stok
    Route::post('store', [StokController::class, 'store'])->name('stok.store'); // Menyimpan stok baru
    Route::get('{id}', [StokController::class, 'show'])->name('stok.show'); // Menampilkan detail stok
    Route::get('{id}/edit', [StokController::class, 'edit'])->name('stok.edit'); // Menampilkan form edit stok
    Route::put('{id}', [StokController::class, 'update'])->name('stok.update'); // Update data stok
    Route::delete('{id}', [StokController::class, 'destroy'])->name('stok.destroy'); // Hapus stok
});

Route::prefix('penjualan')->group(function () {
    Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index'); // Menampilkan daftar penjualan
    Route::get('create', [PenjualanController::class, 'create'])->name('penjualan.create'); // Menampilkan form tambah penjualan
    Route::post('store', [PenjualanController::class, 'store'])->name('penjualan.store'); // Menyimpan penjualan baru
    Route::get('{id}', [PenjualanController::class, 'show'])->name('penjualan.show'); // Menampilkan detail penjualan 
    Route::get('{id}/edit', [PenjualanController::class, 'edit'])->name('penjualan.edit'); // Menampilkan form edit penjualan 
    Route::put('{id}', [PenjualanController::class, 'update'])->name('penjualan.update'); // Update data penjualan 
    Route::delete('{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy'); // Hapus penjualan 
});

Route::group(['prefix' => 'penjualan_detail'], function () {
    Route::get('/', [PenjualanDetailController::class, 'index'])->name('penjualan_detail.index');
    Route::get('/create', [PenjualanDetailController::class, 'create'])->name('penjualan_detail.create');
    Route::post('/', [PenjualanDetailController::class, 'store'])->name('penjualan_detail.store');
    Route::get('/{id}', [PenjualanDetailController::class, 'show'])->name('penjualan_detail.show');
    Route::get('/{id}/edit', [PenjualanDetailController::class, 'edit'])->name('penjualan_detail.edit');
    Route::put('/{id}', [PenjualanDetailController::class, 'update'])->name('penjualan_detail.update');
    Route::delete('/{id}', [PenjualanDetailController::class, 'destroy'])->name('penjualan_detail.destroy');
});