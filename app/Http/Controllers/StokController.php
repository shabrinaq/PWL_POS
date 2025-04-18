<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\UserModel;
use Illuminate\Http\Request;

class StokController extends Controller
{
    // Tampilkan semua stok
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];
        $page = (object) [
            'title' => 'Stok yang tercatat dalam sistem'
        ];
        $activeMenu = 'stok';

        $barang = Barang::all();
        $user = UserModel::all();

        $query = Stok::with(['barang', 'user']);

        // Filter berdasarkan barang_id jika ada
        if ($request->has('barang_id') && $request->barang_id != '') {
            $query->where('barang_id', $request->barang_id);
        }

        $stok = $query->get();

        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu', 'stok', 'barang', 'user'));
    }

    // Tampilkan form tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah Stok Baru'
        ];
        $activeMenu = 'stok';

        $barang = Barang::all();
        $user = UserModel::all();

        return view('stok.create', compact('breadcrumb', 'page', 'activeMenu', 'barang', 'user'));
    }

    // Simpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        Stok::create($request->all());

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan.');
    }

    // Tampilkan detail stok
    public function show($id)
    {
        $stok = Stok::with(['barang', 'user'])->find($id);

        if (!$stok) {
            return redirect('/stok')->with('error', 'Data tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail Stok'
        ];
        $activeMenu = 'stok';

        return view('stok.show', compact('breadcrumb', 'page', 'activeMenu', 'stok'));
    }

    // Tampilkan form edit stok
    public function edit($id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return redirect('/stok')->with('error', 'Data tidak ditemukan.');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit Stok'
        ];
        $activeMenu = 'stok';

        $barang = Barang::all();
        $user = UserModel::all();

        return view('stok.edit', compact('breadcrumb', 'page', 'activeMenu', 'stok', 'barang', 'user'));
    }

    // Update data stok
    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:m_barang,barang_id',
            'user_id' => 'required|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1'
        ]);

        $stok = Stok::find($id);

        if (!$stok) {
            return redirect('/stok')->with('error', 'Data tidak ditemukan.');
        }

        $stok->update([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diperbarui.');
    }

    // Hapus data stok
    public function destroy($id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return redirect('/stok')->with('error', 'Data tidak ditemukan.');
        }

        $stok->delete();

        return redirect('/stok')->with('success', 'Data stok berhasil dihapus.');
    }
}