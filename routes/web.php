<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/daftar', function () {
    return view('Akun');
});

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// Optional: Keep individual routes for direct access
Route::get('/laporan/harian', [LaporanController::class, 'dailySalesReport'])->name('daily.sales.report');
Route::get('/laporan/mingguan', [LaporanController::class, 'weeklySalesReport'])->name('weekly.sales.report');
Route::get('/laporan/bulanan', [LaporanController::class, 'monthlySalesReport'])->name('monthly.sales.report');
