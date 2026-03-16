<?php

use Illuminate\Support\Facades\Route;
use Modules\DocumentPendataanAnggota\Http\Controllers\DocumentPendataanAnggotaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('documentpendataananggotas', DocumentPendataanAnggotaController::class)->names('documentpendataananggota');
});
