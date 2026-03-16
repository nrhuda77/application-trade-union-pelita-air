<?php

use Illuminate\Support\Facades\Route;
use Modules\MasukanSaran\Http\Controllers\MasukanSaranController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('masukansarans', MasukanSaranController::class)->names('masukansaran');
});
