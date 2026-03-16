<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginAnggota\Http\Controllers\LoginAnggotaController;
use Modules\Pendaftaran\Http\Controllers\PendaftaranAnggotaController;
use Modules\Pendaftaran\Http\Controllers\PendaftaranController;

Route::get('/pendaftaran-anggota', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran-anggota', [PendaftaranController::class, 'show']);
Route::get('/ajax-data-pendaftaran-anggota/{id}', [PendaftaranController::class, 'ajax_data']);
Route::post('/approval-data-pendaftaran-anggota', [PendaftaranController::class, 'approval']);
Route::post('/update-data-pendaftaran-anggota', [PendaftaranController::class, 'update']);
Route::post('/import-data-pendaftaran-anggota', [PendaftaranController::class, 'import']);

Route::get('/pendaftaran', [PendaftaranAnggotaController::class, 'index']);
Route::get('/cek-data-pendaftar/{nama}/{nip}', [PendaftaranAnggotaController::class, 'cek']);
route::post('/buat-pendaftaran', [PendaftaranAnggotaController::class, 'store']);
route::get('/send-ulang-email-pendaftaran/{email}/{uuid}', [PendaftaranAnggotaController::class, 'send_text_email']);
Route::get('/result-pendaftaran/{email}/{uuid}', [PendaftaranController::class, 'result'])->name('result');