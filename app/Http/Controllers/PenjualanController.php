<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\UserModel;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Menampilkan halaman daftar penjualan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar semua transaksi penjualan'
        ];

        $activeMenu = 'penjualan';

        $penjualans = Penjualan::with('user')->get(); // Ambil data beserta user-nya

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'penjualans' => $penjualans
        ]);
    }

    // Menampilkan halaman form tambah penjualan
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Penjualan Baru'
        ];

        $activeMenu = 'penjualan';
        $users = UserModel::all(); // Digunakan untuk pilihan user_id

        return view('penjualan.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'users' => $users
        ]);
    }

    // Menyimpan data penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date'
        ]);

        // Generate kode otomatis
        $lastId = Penjualan::max('penjualan_id') + 1;
        $kode = 'PNJ-' . str_pad($lastId, 3, '0', STR_PAD_LEFT);

        Penjualan::create([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $kode,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    // Menampilkan detail penjualan
    public function show(string $id)
    {
        $penjualan = Penjualan::with('user')->find($id);

        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan form edit penjualan
    public function edit(string $id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Penjualan'
        ];

        $activeMenu = 'penjualan';
        $users = UserModel::all();

        return view('penjualan.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'users' => $users,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data penjualan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date'
        ]);

        $penjualan = Penjualan::find($id);
        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data tidak ditemukan');
        }

        $penjualan->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_tanggal' => $request->penjualan_tanggal
        ]);

        return redirect('/penjualan')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus penjualan
    public function destroy(string $id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data tidak ditemukan');
        }

        try {
            $penjualan->delete();
            return redirect('/penjualan')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/penjualan')->with('error', 'Gagal menghapus data');
        }
    }
}