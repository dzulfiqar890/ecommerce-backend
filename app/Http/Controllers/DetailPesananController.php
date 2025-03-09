<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    // Tampilkan semua detail pesanan
    public function index()
    {
        $detailPesanan = DetailPesanan::all();
        return response()->json($detailPesanan);
    }

    // Simpan detail pesanan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pesanan'   => 'required|exists:pesanan,id',
            'id_produk'    => 'required|exists:produk,id',
            'jumlah'       => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'harga_subtotal' => 'required|numeric',
        ]);

        $detailPesanan = DetailPesanan::create($data);
        return response()->json($detailPesanan, 201);
    }

    // Tampilkan detail satu detail pesanan
    public function show($id)
    {
        $detailPesanan = DetailPesanan::findOrFail($id);
        return response()->json($detailPesanan);
    }

    // Update detail pesanan
    public function update(Request $request, $id)
    {
        $detailPesanan = DetailPesanan::findOrFail($id);
        $data = $request->validate([
            'id_pesanan'   => 'sometimes|required|exists:pesanan,id',
            'id_produk'    => 'sometimes|required|exists:produk,id',
            'jumlah'       => 'sometimes|required|integer',
            'harga_satuan' => 'sometimes|required|numeric',
            'harga_subtotal' => 'sometimes|required|numeric',
        ]);

        $detailPesanan->update($data);
        return response()->json($detailPesanan);
    }

    // Hapus detail pesanan
    public function destroy($id)
    {
        $detailPesanan = DetailPesanan::findOrFail($id);
        $detailPesanan->delete();
        return response()->json(['message' => 'Detail Pesanan deleted successfully']);
    }
}
