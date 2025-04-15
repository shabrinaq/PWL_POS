<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // public function index()
    // {
        /* $data = [
            'kategori_kode' => 'SNK',
            'kategori_nama' => 'Snack/Makanan Ringan',
            'created_at' => now()
        ];

        DB::table('m_kategori')->insert($data);
        return "Insert data baru berhasil"; */

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';

        /* $data = DB::table('m_kategori')->get();
        return view('kategori', ['data' => $data]); */
    // } 

    // Tampilkan semua kategori
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Kategori yang tersedia'
        ];

        $activeMenu = 'kategori';

        $kategori = Kategori::all();

        return view('kategori.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'kategori' => $kategori
        ]);
    }

    // Tampilkan form tambah
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Kategori Baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|max:10|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|max:100',
        ]);

        Kategori::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan.');
    }

    // Tampilkan detail
    public function show($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_kode' => 'required|max:10|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|max:100',
        ]);

        $kategori = Kategori::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data tidak ditemukan.');
        }

        $kategori->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function delete($id)
    {
        $kategori = Kategori::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data tidak ditemukan.');
        }

        $kategori->delete();

        return redirect('/kategori')->with('success', 'Data berhasil dihapus.');
    }
}