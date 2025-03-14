<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // Tampilkan semua data pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::with('pesanan')->get();
        return response()->json($pembayaran);
    }

    // Simpan pembayaran baru
    public function store(Request $request)
{
    $data = $request->validate([
        'id_pesanan'         => 'required|exists:pesanan,id',
        'metode_pembayaran'  => 'required|in:transfer_bank,e-wallet,kartu_kredit,cod',
        // tanggal_pembayaran otomatis di-set menggunakan default CURRENT_TIMESTAMP di migration
        'jumlah_pembayaran'  => 'nullable|numeric', // kita isi otomatis nanti
        // status tidak perlu divalidasi dari input karena akan diubah otomatis
    ]);

    // Ambil data pesanan terkait
    $pesanan = \App\Models\Pesanan::findOrFail($data['id_pesanan']);

    // Isi jumlah pembayaran dari total harga pesanan
    $data['jumlah_pembayaran'] = $pesanan->total_harga;


    // Simpan data pembayaran
    $pembayaran = Pembayaran::create($data);

    // Update status pesanan menjadi 'paid'
    $pesanan->status = 'paid';
    $pesanan->save();

    return response()->json($pembayaran, 201);
}


    // Tampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::with('pesanan')->findOrFail($id);
        return response()->json($pembayaran);
    }

    // Update data pembayaran
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $data = $request->validate([
            'id_pesanan'         => 'sometimes|required|exists:pesanan,id',
            'metode_pembayaran'  => 'sometimes|required|in:transfer_bank,e-wallet,kartu_kredit,cod',
        ]);

        if (isset($data['id_pesanan'])) {
            $pesanan = Pesanan::findOrFail($data['id_pesanan']);
            $data['jumlah_pembayaran'] = $pesanan->total_harga;
            $data['status'] = $pesanan->status;
        }

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
