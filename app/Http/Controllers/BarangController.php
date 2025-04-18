<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Tampilkan semua barang
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $page = (object) [
            'title' => 'Barang yang tersedia'
        ];
        $activeMenu = 'barang';
    
        $kategori = Kategori::all();
    
        $query = Barang::query();
    
        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }
    
        $barang = $query->get();
    
        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu', 'barang', 'kategori'));
    }
    

    // Tampilkan form tambah barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang Baru'
        ];

        $activeMenu = 'barang';

        $kategori = Kategori::all();

        return view('barang.create', compact('kategori', 'breadcrumb', 'page', 'activeMenu'));
    }

    // Simpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|max:10|unique:m_barang,barang_kode',
            'barang_nama' => 'required|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        Barang::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'kategori_id' => $request->kategori_id,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan.');
    }

    // Tampilkan detail barang
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Data tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', compact('breadcrumb', 'page', 'activeMenu', 'barang'));
    }

    // Tampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Data tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';

        $kategori = Kategori::all();

        return view('barang.edit', compact('breadcrumb', 'page', 'activeMenu', 'barang', 'kategori'));
    }

    // Update data barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_kode' => 'required|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        $barang = Barang::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Data tidak ditemukan.');
        }

        $barang->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'kategori_id' => $request->kategori_id,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    /// Hapus barang
    public function destroy($id)
    {
    $barang = Barang::find($id);

    if (!$barang) {
        return redirect('/barang')->with('error', 'Data tidak ditemukan.');
    }

    $barang->delete();

    return redirect('/barang')->with('success', 'Data barang berhasil dihapus.');
}

}