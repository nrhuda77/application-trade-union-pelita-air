<?php

use Illuminate\Support\Facades\Route;
use Modules\LaporanKeuangan\Http\Controllers\LaporanKeuanganController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('laporankeuangans', LaporanKeuanganController::class)->names('laporankeuangan');
});
