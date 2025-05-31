<?php
// app/Models/Pesanan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DetailPesanan;


class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_users', 'tanggal_pesanan', 'status', 'total_harga'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_users');
    }
}
