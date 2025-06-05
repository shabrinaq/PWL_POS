<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return Barang::all();
    }

    public function store(Request $request)
    {
        $barang = Barang::create($request->all());

        return response()->json($barang, 201);
    }

    public function show($id)
    {
        return Barang::find($id);
    }

    public function update(Request $request, Barang $barang)
    {
        $barang->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Updated',
            'data' => $barang,
        ]);
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Deleted',
        ]);
    }

    public function add_image(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'barang_kode' => 'required',
            'barang_nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // simpan file gambar
        $imagePath = $request->file('image')->store('barang', 'public');
        $imageName = basename($imagePath);

        // Simpan data ke database
        $barang = Barang::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $imagePath, // Disimpan hanya path-nya
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan dengan gambar',
            'data' => [
                'kategori_id' => $barang->kategori_id,
                'barang_kode' => $barang->barang_kode,
                'barang_nama' => $barang->barang_nama,
                'harga_beli' => $barang->harga_beli,
                'harga_jual' => $barang->harga_jual,
                'image' => asset('storage/' . $barang->image), 
                'created_at' => $barang->created_at,
                'updated_at' => $barang->updated_at,
            ]
        ], 201);
    }
}