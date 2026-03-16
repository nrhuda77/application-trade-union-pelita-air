<?php

use Illuminate\Support\Facades\Route;
use Modules\AnggotaSerikat\Http\Controllers\AnggotaSerikatController;

Route::get('/anggota-serikat', [AnggotaSerikatController::class, 'index'])->middleware('auth');
Route::post('/anggota-serikat', [AnggotaSerikatController::class, 'show'])->middleware('auth');
Route::get('/ajax-data-anggota-serikat/{id}', [AnggotaSerikatController::class, 'ajax_data'])->middleware('auth');
Route::post('/update-data-anggota-serikat', [AnggotaSerikatController::class, 'update'])->middleware('auth');