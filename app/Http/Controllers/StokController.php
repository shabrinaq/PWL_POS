<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Barang;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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

    public function list(Request $request)
    {
        $stoks = Stok::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['barang', 'user']);

        if ($request->barang_id) {
            $stoks->where('barang_id', $request->barang_id);
        }

        return DataTables::of($stoks)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                $btn  = '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
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

    public function create_ajax()
    {
        $barang = Barang::all();
        $user = UserModel::all();
        return view('stok.create_ajax', ['barang' => $barang, 'user' => $user]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            Stok::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data stok berhasil disimpan'
            ]);
        }
        return redirect('/');
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

    public function show_ajax(string $id)
    {
        $stok = Stok::with(['barang', 'user'])->find($id);
        return view('stok.show_ajax', compact('stok'));
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

    public function edit_ajax($id)
    {
        $stok = Stok::find($id);
        $barang = Barang::all();
        $user = UserModel::all();
        return view('stok.edit_ajax', compact('stok', 'barang', 'user'));
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

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_id' => 'required|integer',
                'user_id' => 'required|integer',
                'stok_tanggal' => 'required|date',
                'stok_jumlah' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $stok = Stok::find($id);
            if ($stok) {
                $stok->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $stok = Stok::find($id);
        return view('stok.confirm_ajax', ['stok' => $stok]);
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

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $stok = Stok::find($id);
            if ($stok) {
                try {
                    Stok::destroy($id);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data stok gagal dihapus karena masih terkait dengan data lain'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}