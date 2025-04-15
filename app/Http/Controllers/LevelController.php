<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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


   /* public function list(Request $request)
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
}

// commit awal terhapus