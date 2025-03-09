<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Tampilkan semua data pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return response()->json($pembayaran);
    }

    // Simpan pembayaran baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pesanan'         => 'required|exists:pesanan,id_pesanan',
            'metode_pembayaran'  => 'required|in:transfer_bank,e-wallet,kartu_kredit,cod',
            // tanggal_pembayaran otomatis di-set menggunakan default CURRENT_TIMESTAMP di migration
            'jumlah_pembayaran'  => 'required|numeric',
            'status'             => 'required|in:pending,success,failed',
        ]);

        $pembayaran = Pembayaran::create($data);
        return response()->json($pembayaran, 201);
    }

    // Tampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return response()->json($pembayaran);
    }

    // Update data pembayaran
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $data = $request->validate([
            'id_pesanan'         => 'sometimes|required|exists:pesanan,id',
            'metode_pembayaran'  => 'sometimes|required|in:transfer_bank,e-wallet,kartu_kredit,cod',
            'jumlah_pembayaran'  => 'sometimes|required|numeric',
            'status'             => 'sometimes|required|in:pending,success,failed',
        ]);

        $pembayaran->update($data);
        return response()->json($pembayaran);
    }

    // Hapus data pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return response()->json(['message' => 'Pembayaran deleted successfully']);
    }
}
