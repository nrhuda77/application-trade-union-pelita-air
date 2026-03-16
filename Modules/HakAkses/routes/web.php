<?php

use Illuminate\Support\Facades\Route;
use Modules\HakAkses\Http\Controllers\HakAksesController;

Route::get('/hak-akses', [HakAksesController::class, 'index'])->middleware('auth');
Route::post('/hak-akses', [HakAksesController::class, 'show'])->middleware('auth');
Route::post('/insert-hak-akses', [HakAksesController::class, 'store'])->middleware('auth');
Route::get('/ajax-hak-akses/{id}', [HakAksesController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-hak-akses', [HakAksesController::class, 'update'])->middleware('auth');
Route::get('/delete-hak-akses/{id}', [HakAksesController::class, 'destroy'])->middleware('auth');