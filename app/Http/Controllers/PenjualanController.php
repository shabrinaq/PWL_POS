<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\PendingChain;

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
            'title' => 'Daftar Penjualan yang terdaftar dalam sistem'
        ];
        $kategori = Penjualan::all();
        $users = UserModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu,
            'users' => $users
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

    public function create_ajax()
    {
        $users = UserModel::all();
        return view('penjualan.create_ajax', compact('users'));
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

     public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:m_user,user_id', // ganti ini
            'pembeli' => 'required|string|min:3',
            'penjualan_kode' => 'required|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msgField' => $validator->errors()]);
        }

        Penjualan::create($request->all());
        return response()->json(['status' => true, 'message' => 'Data penjualan berhasil disimpan']);
    }


    public function confirm_ajax($id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return view('penjualan.error_modal'); // atau langsung lempar view modal error
        }

        return view('penjualan.confirm_ajax', compact('penjualan'));
    }

    public function list(Request $request)
    {
        $data = Penjualan::with(relations: 'user')->select('*');

        if ($request->filled('user_id')) {
            $data->where('user_id', $request->user_id);
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function ($row) {
                return $row->user->nama ?? '-';
            })
            ->addColumn('aksi', function ($row) {
                $btn  = '<button onclick="modalAction(\'' . url('/penjualan/' . $row->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $row->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $row->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
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

    public function show_ajax($id)
    {
        $penjualan = Penjualan::with('user')->find($id); // tambahkan relasi user
        return view('penjualan.show_ajax', compact('penjualan'));
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

    public function edit_ajax($id)
    {
        $penjualan = Penjualan::find($id);
        $users = UserModel::all();
        return view('penjualan.edit_ajax', compact('penjualan', 'users'));
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

    public function update_ajax(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|min:3',
            'penjualan_kode' => "required|unique:t_penjualan,penjualan_kode,{$id},penjualan_id",
            'penjualan_tanggal' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'msgField' => $validator->errors()
            ]);
        }

        $penjualan = Penjualan::find($id);
        $penjualan->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui'
        ]);
    }
    
    public function delete_ajax(Request $request, $id)
    {
        // Pastikan hanya terima request dari AJAX atau JSON
        if ($request->ajax() || $request->wantsJson()) {
            // Ambil data penjualan berdasarkan ID
            $penjualan = Penjualan::find($id);

            if ($penjualan) {
                try {
                    // Coba hapus datanya
                    $penjualan->delete();

                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    // Tangani error karena relasi ke tabel lain
                    return response()->json([
                        'status' => false,
                        'message' => 'Data gagal dihapus karena masih terkait dengan data lain'
                    ]);
                }
            } else {
                // Data tidak ditemukan
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        // Jika bukan AJAX/JSON, redirect ke halaman utama
        return redirect('/');
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