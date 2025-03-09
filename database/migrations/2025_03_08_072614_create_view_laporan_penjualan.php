<?php
// database/migrations/2025_03_08_000006_create_view_laporan_penjualan.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViewLaporanPenjualan extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE VIEW view_laporan_penjualan AS
            SELECT 
                DATE(p.tanggal_pesanan) AS tanggal_laporan,
                SUM(dp.harga_subtotal) AS total_pendapatan,
                COUNT(DISTINCT p.id) AS jumlah_penjualan
            FROM pesanan p
            JOIN detail_pesanan dp ON p.id = dp.id
            WHERE p.status = 'paid'
            GROUP BY DATE(p.tanggal_pesanan)
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS view_laporan_penjualan");
    }
}
