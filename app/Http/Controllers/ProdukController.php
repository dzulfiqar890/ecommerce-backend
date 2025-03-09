<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{

    public function index()
    {
        $produk = Produk::all();
        return response()->json($produk);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_kategori'   => 'required|exists:kategori,id',
            'nama_produk'   => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'harga'         => 'required|numeric',
            'stok'          => 'required|integer',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('gambar_produk')) {
            $path = $request->file('gambar_produk')->store('gambar_produk', 'public');
            $data['gambar_produk'] = Storage::url($path);
        }

        $produk = Produk::create($data);
        return response()->json($produk, 201);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $data = $request->validate([
            'id_kategori'   => 'sometimes|required|exists:kategori,id_kategori',
            'nama_produk'   => 'sometimes|required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'harga'         => 'sometimes|required|numeric',
            'stok'          => 'sometimes|required|integer',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('gambar_produk')) {

            $path = $request->file('gambar_produk')->store('gambar_produk', 'public');
            $data['gambar_produk'] = Storage::url($path);
        }

        $produk->update($data);
        return response()->json($produk);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();
        return response()->json(['message' => 'Produk deleted successfully']);
    }
}
