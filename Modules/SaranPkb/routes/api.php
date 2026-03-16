<?php

use Illuminate\Support\Facades\Route;
use Modules\SaranPkb\Http\Controllers\SaranPkbController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('saranpkbs', SaranPkbController::class)->names('saranpkb');
});
