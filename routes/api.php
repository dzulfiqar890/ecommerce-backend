<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\PembayaranController;

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        
        Route::middleware('admin')->group(function () {
            Route::apiResource('produk', ProdukController::class);
            Route::apiResource('kategori', KategoriController::class);
        });
        Route::get('produk', [ProdukController::class, 'index']);
        Route::get('kategori', [KategoriController::class, 'index']);
        
        Route::apiResource('pesanan', PesananController::class);
        Route::apiResource('detail-pesanan', DetailPesananController::class);
        Route::apiResource('pembayaran', PembayaranController::class);
    });
});
