<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{

    public function index()
{
    $produk = Produk::with('kategori')->get();
    $data = $produk->map(function ($item) {
        $item->nama_kategori = $item->kategori->nama_kategori ?? null;
        unset($item->kategori); 
        return $item;
    });
    return response()->json($produk, 200);
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
        $file = $request->file('gambar_produk');
        $filename = hash('sha256', time() . Str::random(40)) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('gambar_produk', $filename, 'public');
        $data['gambar_produk'] = asset('storage/gambar_produk/' . $filename);
    }
    $produk = Produk::create($data);
    return response()->json($produk, 201);
}

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        $produk->nama_kategori = $produk->kategori->nama_kategori ?? null;
        unset($produk->kategori);
        return response()->json($produk);
    }


    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $data = $request->validate([
            'id_kategori'   => 'nullable|exists:kategori,id',
            'nama_produk'   => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'harga'         => 'nullable|numeric',
            'stok'          => 'nullable|integer',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama jika ada
            if ($produk->gambar_produk) {
                $oldFile = str_replace(asset('storage/'), 'public/', $produk->gambar_produk);
                Storage::delete($oldFile);
            }
            $file = $request->file('gambar_produk');
            $filename = hash('sha256', time() . Str::random(40)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('gambar_produk', $filename, 'public');
            $data['gambar_produk'] = asset('storage/gambar_produk/' . $filename);
        }

        $produk->update($data);
        $produk->load('kategori'); // Load relasi kategori
        return response()->json([
            'id' => $produk->id,
            'nama_produk' => $produk->nama_produk,
            'harga' => $produk->harga,
            'stok' => $produk->stok,
            'deskripsi' => $produk->deskripsi,
            'gambar_produk' => $produk->gambar_produk,
            'kategori_id' => $produk->kategori_id,
            'nama_kategori' => $produk->kategori->nama_kategori ?? null,
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal memperbarui produk', 'error' => $e->getMessage()], 500);
    }       
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        try {
        // Hapus gambar jika ada
        if ($produk->gambar_produk) {
            $file = str_replace(asset('storage/'), 'public/', $produk->gambar_produk);
            Storage::delete($file);
        }
        $produk->delete();
        return response()->json(['message' => 'Produk deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus produk', 'error' => $e->getMessage()], 500);
        }
    }
}
