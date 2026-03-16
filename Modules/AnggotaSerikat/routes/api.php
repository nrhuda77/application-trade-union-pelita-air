<?php

use Illuminate\Support\Facades\Route;
use Modules\AnggotaSerikat\Http\Controllers\AnggotaSerikatController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('anggotaserikats', AnggotaSerikatController::class)->names('anggotaserikat');
});
