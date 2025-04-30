<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
{
    $breadcrumb = (object) [
        'title' => 'Daftar Level',
        'list' => ['Home', 'Levels']
    ];

    $page = (object) [
        'title' => 'Daftar Level yang terdaftar dalam sistem'
    ];

    $activeMenu = 'level';

    $levels = LevelModel::all(); // Ambil semua data level

    return view('level.index', [
        'breadcrumb' => $breadcrumb, 
        'page' => $page, 
        'activeMenu' => $activeMenu,
        'levels' => $levels // <-- tambahkan ini
    ]);
}

/* Public function list(Request $request)
    {
    $users = LevelModel::select('user_id', 'username', 'nama', 'level_id')
        ->with('level');

    return DataTables::of($users)
        // Menambahkan kolom index/no sort
        ->addIndexColumn()
        // Menambahkan kolom action
        ->addColumn('action', function ($level) {
            $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/level/' . $level->level_id) . '">'
                . csrf_field() . method_field('DELETE') . 
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\');">Delete</button>
            </form>';

            return $btn;
        })
        // Memberitahu DataTables bahwa kolom action berisi HTML
        ->rawColumns(['action'])
        ->make(true);
    } */

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
                'level_nama' => 'required|string|max: 100'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            LevelModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    // Menampilkan halaman form tambah Level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list'  => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Level baru'
        ];

        $level = LevelModel::all(); // Ambil data level untuk ditampilkan di form
        $activeMenu = 'Level'; // Set menu yang sedang aktif

        return view('level.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'level'      => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|max:10|unique:m_level,level_kode', // validasi kode level
            'level_nama' => 'required|max:100', // validasi nama level
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data Level berhasil disimpan');
    }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode','level_nama');
    
        // Gunakan nama parameter dari frontend: kategori_filter
        if ($request->kategori_filter) {
            $levels->where('level_id', $request->kategori_filter);
        }
    
        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn  = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }    

    // Menampilkan detail user
    public function show(string $id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect()->route('level.index')->with('error', 'Level tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];

        $activeMenu = 'level'; // Set menu yang sedang aktif

        return view('level.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function show_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.show_ajax', ['level' => $level]);
    }

    // Menampilkan halaman form edit level
    public function edit(string $id)
    {
        $level = LevelModel::find($id); 

        if (!$level) {
            return redirect()->route('level.index')->with('error', 'Level tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|max:10|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama' => 'required|max:100',
        ]);

        $level = LevelModel::find($id);
        if (!$level) {
            return redirect()->route('level.index')->with('error', 'Level tidak ditemukan');
        }

        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Level berhasil diperbarui');
    }

    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', ['level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax 
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|max:100'
            ];

            // use Illuminate\Support\Facades\Validator; 
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal 
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error 
                ]);
            }
            $check = LevelModel::find($id);
            if ($check) {
                if (!$request->filled('password')) { // jika password tidak diisi, maka hapus dari request 
                    $request->request->remove('password');
                }
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        redirect('/');
    }

    // Menghapus level
    public function delete(string $id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('/level')->with('error', 'Level tidak ditemukan');
        }

        try {
            $level->delete();
            return redirect('/level')->with('success', 'Level berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/level')->with('error', 'Terjadi kesalahan saat menghapus level');
        }
    }

    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', ['level' => $level]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if($request->ajax() || $request->wantsJson()){
            $level = LevelModel::find($id);
            if($level){
                try {
                    LevelModel::destroy($id);
                    return response()->json([
                        'status'  => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
                    ]);
                }
            }else{
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
    }
        redirect('/');
    }
}
