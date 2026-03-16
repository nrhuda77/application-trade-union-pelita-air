<?php

use Illuminate\Support\Facades\Route;
use Modules\Pkb\Http\Controllers\PkbController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pkbs', PkbController::class)->names('pkb');
});
