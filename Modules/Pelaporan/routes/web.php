<?php

use Illuminate\Support\Facades\Route;
use Modules\Pelaporan\Http\Controllers\PelaporanController;

Route::get('/laporan-keluhan', [PelaporanController::class, 'index'])->middleware('auth');
Route::post('/laporan-keluhan', [PelaporanController::class, 'show'])->middleware('auth');
Route::get('/ajax-data-laporan-keluhan/{id}', [PelaporanController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-data-laporan-keluhan', [PelaporanController::class, 'update'])->middleware('auth');
Route::get('/update-read-laporan-keluhan/{id}', [PelaporanController::class, 'read'])->middleware('auth');
Route::get('/detail-laporan-keluhan/{id}', [PelaporanController::class, 'detail_admin'])->middleware('auth');

Route::get('/laporan-keluhan-anggota', [PelaporanController::class, 'view_anggota'])->middleware('auth:anggota');
route::get('/get-laporan-keluhan-anggota', [PelaporanController::class, 'show_anggota'])->middleware('auth:anggota');
route::post('/buat-laporan-keluhan-anggota', [PelaporanController::class, 'store'])->middleware('auth:anggota');
Route::get('/ajax-data-laporan-keluhan-anggota/{id}', [PelaporanController::class, 'ajax_data_anggota'])->middleware('auth:anggota');
Route::get('/ajax-histori-laporan-keluhan-anggota/{id}', [PelaporanController::class, 'ajax_data_histori'])->middleware('auth:anggota');
Route::get('/ajax-upload-bukti-tambahan-laporan-keluhan-anggota/{id}', [PelaporanController::class, 'ajax_data_upload'])->middleware('auth:anggota');
Route::post('/update-data-upload-tambahan-laporan-keluhan-anggota', [PelaporanController::class, 'update_upload_tambahan'])->middleware('auth:anggota');
Route::get('/detail-laporan-keluhan-anggota/{id}', [PelaporanController::class, 'detail_anggota'])->middleware('auth:anggota');