<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pesanan;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan'); // Untuk rute web /laporan
    }

    public function salesReport(Request $request)
    {
        $query = Laporan::query();
        $laporan = $query->orderBy('tanggal_laporan', 'desc')->get();
        Log::info('Laporan data fetched', ['laporan' => $laporan->toArray()]);

        if ($laporan->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data laporan'], 404);
        }

        return response()->json($laporan);
    }

    public function dailySalesReport(Request $request)
    {
        $tanggal = $request->get('tanggal', now()->format('Y-m-d'));
        $query = Laporan::query();

        $laporan = $query->where('tanggal_laporan', $tanggal)->first();
        Log::info('Daily laporan data fetched', ['laporan' => $laporan]);

        if (!$laporan) {
            return response()->json(['message' => 'Tidak ada data untuk tanggal yang dipilih'], 404);
        }

        return response()->json($laporan);
    }

    public function weeklySalesReport(Request $request)
    {
        $startWeek = $request->get('start_date', now()->startOfWeek()->format('Y-m-d'));
        $endWeek = $request->get('end_date', now()->endOfWeek()->format('Y-m-d'));
        Log::info('weeklySalesReport called', ['start_date' => $startWeek, 'end_date' => $endWeek]);

        $query = Laporan::query();

        $laporan = $query->whereBetween('tanggal_laporan', [$startWeek, $endWeek])
                         ->orderBy('tanggal_laporan')
                         ->get();
        Log::info('Weekly laporan data fetched', ['laporan' => $laporan->toArray()]);

        if ($laporan->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data untuk rentang tanggal yang dipilih'], 404);
        }

        return response()->json($laporan);
    }

    public function monthlySalesReport(Request $request)
    {
        $year = $request->get('year', now()->year);
        Log::info('monthlySalesReport called', ['year' => $year]);

        $query = Laporan::query();

        $laporan = $query->selectRaw('DATE_FORMAT(tanggal_laporan, "%Y-%m") as month, SUM(total_pendapatan) as total')
                         ->whereYear('tanggal_laporan', $year)
                         ->groupBy('month')
                         ->orderBy('month')
                         ->get();
        Log::info('Monthly laporan data fetched', ['laporan' => $laporan->toArray()]);

        if ($laporan->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data untuk tahun yang dipilih'], 404);
        }

        return response()->json($laporan);
    }

}
