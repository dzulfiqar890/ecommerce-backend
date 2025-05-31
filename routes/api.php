<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DetailPesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;

Route::prefix('v1')->group(function () {
    // Public routes (tidak perlu login)
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    // Public product browsing (untuk guest users)
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index.quest');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show.quest');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index.quest');
    
    // Reports - Laporan Penjualan (menggunakan view_laporan_penjualan)
        Route::get('laporan', [LaporanController::class, 'salesReport']); // Data dari view
        Route::get('laporan/harian', [LaporanController::class, 'dailySalesReport']); 
        Route::get('laporan/mingguan', [LaporanController::class, 'weeklySalesReport']);
        Route::get('laporan/bulanan', [LaporanController::class, 'monthlySalesReport']);
        
        // Stock Management - Monitoring Stok (otomatis dikurangi via trigger)
        // Stok sudah otomatis dikurangi dengan trigger database
    
    // Protected routes (perlu login)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
        
        // ADMIN ONLY ROUTES
        Route::middleware('admin')->prefix('admin')->group(function () {
            // Product Management
            Route::apiResource('produk', ProdukController::class)->names('apiadmin.produk');
            Route::apiResource('kategori', KategoriController::class)->names('apiadmin.kategori');
            
            // Order Management for Admin
            Route::get('pesanan', [PesananController::class, 'index'])->name('indexpesanan.admin'); // Semua pesanan
            Route::get('pesanan/{id}', [PesananController::class, 'show'])->name('showpesanan.admin'); // Detail pesanan any user
            
            // Payment Management for Admin
            Route::get('pembayaran', [PembayaranController::class, 'index'])->name('getpembayaran.admin'); // Semua pembayaran
            Route::get('pembayaran/{id}', [PembayaranController::class, 'show'])->name('showpembayaran.admin');
            
        });
        
        
        // CUSTOMER ONLY ROUTES  
        Route::middleware('customer')->group(function () {
            // Customer Orders - hanya pesanan milik user yang login
            Route::apiResource('pesanan', PesananController::class)->names('apicustomer.pesanan');
            
            // Customer Order Details - otomatis filtered by user
            Route::apiResource('detailpesanan', DetailPesananController::class)->names('apicustomer.detailpesanan');
            
            // Customer Payments - hanya pembayaran milik user yang login
            Route::apiResource('pembayaran', PembayaranController::class)->names('apicustomer.pembayaran');
        });
    });
});