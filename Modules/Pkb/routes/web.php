<?php

use Illuminate\Support\Facades\Route;
use Modules\Pkb\Http\Controllers\PkbAnggotaController;
use Modules\Pkb\Http\Controllers\PkbController;

Route::get('/pkb-admin', [PkbController::class, 'index'])->middleware('auth');
Route::post('/pkb-cetak-admin', [PkbController::class, 'cetak'])->middleware('auth');

Route::get('/pdf-pkb', [PkbAnggotaController::class, 'index'])->middleware('auth:anggota');
Route::get('/download/pdf-pkb', [PkbAnggotaController::class, 'download'])->middleware('auth:anggota');