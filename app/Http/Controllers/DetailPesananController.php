<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPesananController extends Controller
{
    // Tampilkan semua detail pesanan dengan relasi produk dan pesanan
    public function index()
    {
        $detailPesanan = DetailPesanan::with(['produk:id,nama_produk,harga', 'pesanan'])->get();
        return response()->json($detailPesanan);
    }

    // Simpan detail pesanan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pesanan'   => 'required|exists:pesanan,id',
            'id_produk'    => 'required|exists:produk,id',
            'jumlah'       => 'required|integer|min:1',
        ]);

        // Ambil harga produk
        $produk = Produk::findOrFail($data['id_produk']);

        // Hitung subtotal
        $data['harga_subtotal'] = $produk->harga * $data['jumlah'];

        // Simpan detail pesanan
        $detailPesanan = DetailPesanan::create($data);

        // Update total_harga di pesanan
        $this->updateTotalHargaPesanan($data['id_pesanan']);

        return response()->json($detailPesanan, 201);
    }

    // Tampilkan detail satu detail pesanan
    public function show($id)
    {
        $detailPesanan = DetailPesanan::with(['produk:id,nama_produk,harga', 'pesanan'])->findOrFail($id);
        return response()->json($detailPesanan);
    }

    // Update detail pesanan
    public function update(Request $request, $id)
    {
        $detailPesanan = DetailPesanan::findOrFail($id);

        $data = $request->validate([
            'id_pesanan'   => 'sometimes|required|exists:pesanan,id',
            'id_produk'    => 'sometimes|required|exists:produk,id',
            'jumlah'       => 'sometimes|required|integer|min:1',
        ]);

        // Gunakan nilai lama jika tidak dikirim
        $id_produk = $data['id_produk'] ?? $detailPesanan->id_produk;
        $jumlah = $data['jumlah'] ?? $detailPesanan->jumlah;

        // Hitung ulang harga subtotal
        $produk = Produk::findOrFail($id_produk);
        $data['harga_subtotal'] = $produk->harga * $jumlah;

        // Update detail pesanan
        $detailPesanan->update($data);

        // Update total_harga di pesanan
        $idPesanan = $data['id_pesanan'] ?? $detailPesanan->id_pesanan;
        $this->updateTotalHargaPesanan($idPesanan);

        return response()->json($detailPesanan);
    }

    // Hapus detail pesanan
    public function destroy($id)
    {
        $detailPesanan = DetailPesanan::findOrFail($id);
        $idPesanan = $detailPesanan->id_pesanan;

        $detailPesanan->delete();

        // Update total_harga di pesanan
        $this->updateTotalHargaPesanan($idPesanan);

        return response()->json(['message' => 'Detail Pesanan deleted successfully']);
    }

    // 🔥 Fungsi bantu untuk update total_harga
    private function updateTotalHargaPesanan($idPesanan)
    {
        $total = DetailPesanan::where('id_pesanan', $idPesanan)->sum('harga_subtotal');
        Pesanan::where('id', $idPesanan)->update(['total_harga' => $total]);
    }
}
