<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        return Kategori::all();
    }

    public function store(Request $request)
    {
        $kategori = Kategori::create($request->all());

        return response()->json($kategori, 201);
    }

    public function show($id)
    {
        return Kategori::find($id);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $kategori->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Updated',
            'data' => $kategori,
        ]);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Deleted',
        ]);
    }
}