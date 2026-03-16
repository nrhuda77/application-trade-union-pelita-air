<?php

use Illuminate\Support\Facades\Route;
use Modules\MasukanSaran\Http\Controllers\MasukanSaranController;

Route::get('/masukan-saran', [MasukanSaranController::class, 'index'])->middleware('auth');
Route::post('/masukan-saran', [MasukanSaranController::class, 'show'])->middleware('auth');
Route::get('/ajax-data-masukan-saran/{id}', [MasukanSaranController::class, 'ajax_data'])->middleware('auth');
Route::get('/detail-masukan-saran/{id}', [MasukanSaranController::class, 'detail_admin'])->middleware('auth');

Route::get('/masukan-saran-anggota', [MasukanSaranController::class, 'index'])->middleware('auth:anggota');
// Route::post('/masukan-saran-anggota', [MasukanSaranController::class, 'show'])->middleware('auth:anggota');
Route::post('/insert-masukan-saran-anggota', [MasukanSaranController::class, 'store'])->middleware('auth:anggota');
// Route::get('/ajax-data-masukan-saran-anggota/{id}', [MasukanSaranController::class, 'ajax_data'])->middleware('auth:anggota');
// Route::get('/detail-masukan-saran-anggota/{id}', [MasukanSaranController::class, 'detail_admin'])->middleware('auth:anggota');