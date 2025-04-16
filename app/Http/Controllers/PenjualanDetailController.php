<?php

namespace App\Http\Controllers;

use App\Models\Penjualan_Detail;
use App\Models\Penjualan;
use App\Models\Barang;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    // Menampilkan daftar detail penjualan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Data Detail Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        $details = Penjualan_Detail::with(['penjualan', 'barang'])->get();

        return view('penjualan_detail.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'details' => $details
        ]);
    }

    // Menampilkan form tambah detail penjualan
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Detail Penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        $penjualans = Penjualan::all();
        $barangs = Barang::all();

        return view('penjualan_detail.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
            'penjualans' => $penjualans,
            'barangs' => $barangs
        ]);
    }

    // Menyimpan detail penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:t_penjualan,penjualan_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1'
        ]);

        Penjualan_Detail::create($request->all());

        return redirect('/penjualan_detail')->with('success', 'Data detail penjualan berhasil disimpan');
    }

    // Menampilkan detail dari 1 data detail penjualan
    public function show(string $id)
    {
        $detail = Penjualan_Detail::with(['penjualan', 'barang'])->find($id);

        if (!$detail) {
            return redirect('/penjualan_detail')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail',
            'list' => ['Home', 'Detail Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        return view('penjualan_detail.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan form edit
    public function edit(string $id)
    {
        $detail = Penjualan_Detail::find($id);

        if (!$detail) {
            return redirect('/penjualan_detail')->with('error', 'Data tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Detail Penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        $penjualans = Penjualan::all();
        $barangs = Barang::all();

        return view('penjualan_detail.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'detail' => $detail,
            'penjualans' => $penjualans,
            'barangs' => $barangs,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:t_penjualan,penjualan_id',
            'barang_id' => 'required|exists:m_barang,barang_id',
            'harga' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1'
        ]);

        $detail = Penjualan_Detail::find($id);

        if (!$detail) {
            return redirect('/penjualan_detail')->with('error', 'Data tidak ditemukan');
        }

        $detail->update($request->all());

        return redirect('/penjualan_detail')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy(string $id)
    {
        $detail = Penjualan_Detail::find($id);

        if (!$detail) {
            return redirect('/penjualan_detail')->with('error', 'Data tidak ditemukan');
        }

        try {
            $detail->delete();
            return redirect('/penjualan_detail')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/penjualan_detail')->with('error', 'Gagal menghapus data');
        }
    }
}