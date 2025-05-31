<?php
// database/migrations/2025_03_08_000007_create_trigger_kurangi_stok.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggerKurangiStok extends Migration
{
    public function up()
    {
        DB::unprepared("
            CREATE TRIGGER kurangi_stok_setelah_pesanan
            AFTER INSERT ON detail_pesanan
            FOR EACH ROW
            BEGIN
                UPDATE produk 
                SET stok = stok - NEW.jumlah
                WHERE id = NEW.id_produk;
            END;
        ");
    }

    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS kurangi_stok_setelah_pesanan");
    }
}
