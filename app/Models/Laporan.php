<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'view_laporan_penjualan';
    public $timestamps = false;
    
    protected $casts = [
        'tanggal_laporan' => 'date',
        'total_pendapatan' => 'decimal:2',
        'jumlah_penjualan' => 'integer',
    ];
}