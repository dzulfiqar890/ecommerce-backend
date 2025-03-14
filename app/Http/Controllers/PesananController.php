<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Tampilkan semua pesanan dengan relasi detailPesanan dan produk
    public function index()
    {
        $pesanan = Pesanan::with(['detailPesanan.produk:id,nama_produk,harga'])->get();
        return response()->json($pesanan);
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pengguna' => 'required|exists:pengguna,id',
            'status'      => 'required|in:pending,paid',
            // Tidak perlu input total_harga, akan diupdate otomatis dari DetailPesananController
        ]);

        // Buat pesanan dengan total_harga awal 0
        $data['total_harga'] = 0;
        $pesanan = Pesanan::create($data);

        return response()->json($pesanan, 201);
    }
    public function getTotalHargaAttribute()
{
    return $this->detailPesanan->sum('harga_subtotal');
}

    // Tampilkan detail satu pesanan dengan relasi detailPesanan dan produk
    public function show($id)
    {
        $pesanan = Pesanan::with(['detailPesanan.produk:id,nama_produk,harga'])->findOrFail($id);
        return response()->json($pesanan);
    }

    // Update pesanan
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $data = $request->validate([
            'id_pengguna' => 'sometimes|required|exists:pengguna,id',
            'status'      => 'sometimes|required|in:pending,paid',
            // total_harga tidak perlu diupdate manual
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
