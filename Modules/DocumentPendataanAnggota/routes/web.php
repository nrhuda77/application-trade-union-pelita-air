<?php

use Illuminate\Support\Facades\Route;
use Modules\DocumentPendataanAnggota\Http\Controllers\DocumentPendataanAnggotaController;

Route::get('/document-pendataan-anggota', [DocumentPendataanAnggotaController::class, 'index'])->middleware('auth');
Route::post('/get-document-pendataan-anggota', [DocumentPendataanAnggotaController::class, 'get'])->middleware('auth');