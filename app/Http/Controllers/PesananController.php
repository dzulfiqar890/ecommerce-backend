<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $pesanan = Pesanan::all();
        return response()->json($pesanan);
    }

    // Simpan pesanan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            // Jika menggunakan autentikasi, kamu bisa mengambil id_pengguna dari user yang login
            'id_pengguna' => 'required|exists:pengguna,id',
            // tanggal_pesanan otomatis di-set menggunakan default CURRENT_TIMESTAMP di migration
            'status'      => 'required|in:pending,paid,shipped,delivered,cancelled',
            'total_harga' => 'required|numeric',
        ]);

        $pesanan = Pesanan::create($data);
        return response()->json($pesanan, 201);
    }

    // Tampilkan detail pesanan
    public function show($id)
    {
        $pesanan = Pesanan::with('detailPesanan')->findOrFail($id);
        return response()->json($pesanan);
    }

    // Update pesanan
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $data = $request->validate([
            'id_pengguna' => 'sometimes|required|exists:pengguna,id',
            'status'      => 'sometimes|required|in:pending,paid,shipped,delivered,cancelled',
            'total_harga' => 'sometimes|required|numeric',
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
