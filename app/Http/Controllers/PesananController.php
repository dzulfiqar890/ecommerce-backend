<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Tampilkan semua pesanan dengan relasi detailPesanan dan produk
    public function index()
    {
        $pesanan = Pesanan::with([
            'users:id,name',
            'detailPesanan.produk:id,nama_produk,harga'
        ])->get();

        return response()->json($pesanan);
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_users' => 'required|exists:users,id',
            'status'  => 'in:pending,paid',
        ]);

        $data['total_harga'] = 0;
        $pesanan = Pesanan::create($data);

        return response()->json($pesanan, 201);
    }

    // Tampilkan detail satu pesanan dengan relasi user, detail dan produk
    public function show($id)
    {
        $pesanan = Pesanan::with([
            'users:id,name',
            'detailPesanan.produk:id,nama_produk,harga'
        ])->findOrFail($id);

        return response()->json($pesanan);
    }

    // Update pesanan
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $data = $request->validate([
            'id_users' => 'sometimes|required|exists:users,id',
            'status'  => 'sometimes|in:pending,paid',
        ]);

        $pesanan->update($data);

        return response()->json($pesanan);
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return response()->json(['message' => 'Pesanan deleted successfully']);
    }
}
