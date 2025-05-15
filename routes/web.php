<?php


use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
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

Route:: pattern('id','[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route:: get('login', [AuthController:: class,'login' ])->name('login' );
Route:: post('login', [AuthController:: class,'postlogin']);
Route:: get('logout', [AuthController:: class,'logout' ])->middleware('auth');

Route:: middleware(['auth' ])->group(function(){ // artinya semua route di dalam group ini harus login dulu

// masukkan semua route yang perlu autentikasi di sini

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


Route::middleware(['authorize:ADM'])->group(function () {
    Route::group(['prefix' => 'level'], function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::post('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']);
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        Route::delete('/{id}', [LevelController::class, 'destroy']);
    });
});

Route::group(['prefix'=>'kategori'], function(){
    Route::get('/', [KategoriController::class,'index']);
    Route::post('/list', [KategoriController::class,'list']);
    Route::get('/create', [KategoriController::class,'create']);
    Route::post('/', [KategoriController::class,'store']);
    Route::get('/create_ajax', [KategoriController::class,'create_ajax']);
    Route::post('/ajax', [KategoriController::class,'store_ajax']);
    Route::get('/{id}', [KategoriController::class,'show']);
    Route::get('/{id}/edit', [KategoriController::class,'edit']);
    Route::put('/{id}', [KategoriController::class,'update']);
    Route::get('/{id}/edit_ajax', [KategoriController::class,'edit_ajax']);
    Route::put('/{id}/update_ajax', [KategoriController::class,'update_ajax']);
    Route::get('/{id}/delete_ajax', [KategoriController::class,'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [KategoriController::class,'delete_ajax']);
    Route::get('/{id}/show_ajax', [KategoriController::class,'show_ajax']);
    Route::delete('/{id}', [KategoriController::class,'destroy']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::post('/', [BarangController::class, 'store']);
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/ajax', [BarangController::class, 'store_ajax']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']);         
    Route::post('/list', [StokController::class, 'list']);          
    Route::get('/create', [StokController::class, 'create']);        
    Route::post('/', [StokController::class, 'store']);         
    Route::get('/create_ajax', [StokController::class, 'create_ajax']);   
    Route::post('/ajax', [StokController::class, 'store_ajax'])->name('stok.store_ajax');    
    Route::get('/{id}', [StokController::class, 'show']);          
    Route::get('/{id}/edit', [StokController::class, 'edit']);          
    Route::put('/{id}', [StokController::class, 'update']);        
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);     
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);   
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);  
    Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']);   
    Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);     
    Route::delete('/{id}', [StokController::class, 'destroy']);       
});

Route::group(['prefix' => 'penjualan'], function () {
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

});