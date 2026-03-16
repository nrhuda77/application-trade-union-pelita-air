<?php

use Illuminate\Support\Facades\Route;
use Modules\LoginAnggota\Http\Controllers\LoginAnggotaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('loginanggotas', LoginAnggotaController::class)->names('loginanggota');
});
