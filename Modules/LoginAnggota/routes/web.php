<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginAnggota\Http\Controllers\LoginAnggotaController;

Route::get('/login', [LoginAnggotaController::class, 'index'])->name('login');
route::post('/login', [LoginAnggotaController::class, 'auth']);
route::post('/logout', [LoginAnggotaController::class, 'logout'])->name('logout-user');
route::get('/registrasi-pendaftaran/{uuid}', [LoginAnggotaController::class, 'register'])->name('registrasi');
route::post('/registrasi-pendaftaran', [LoginAnggotaController::class, 'store']);
route::get('/forgot-password/verif-email', [LoginAnggotaController::class, 'verif_email_forgot_password']);
route::post('/forgot-password/send-verif-email', [LoginAnggotaController::class, 'send_verif_email_forgot_password']);
route::get('/reset-password/{token}/{email}', [LoginAnggotaController::class, 'reset_password']);
route::post('/update-password', [LoginAnggotaController::class, 'update_new_password']);