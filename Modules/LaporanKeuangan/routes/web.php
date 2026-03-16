<?php

use Illuminate\Support\Facades\Route;
use Modules\LaporanKeuangan\Http\Controllers\LaporanKeuanganController;

Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->middleware('auth');
Route::post('/laporan-keuangan', [LaporanKeuanganController::class, 'show'])->middleware('auth');
Route::post('/import-data-laporan-keuangan', [LaporanKeuanganController::class, 'import'])->middleware('auth');

Route::get('/laporan-keuangan-serikat', [LaporanKeuanganController::class, 'anggota'])->middleware('auth:anggota');
Route::post('/laporan-keuangan-serikat', [LaporanKeuanganController::class, 'show'])->middleware('auth:anggota');