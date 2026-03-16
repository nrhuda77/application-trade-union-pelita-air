<?php

use Illuminate\Support\Facades\Route;
use Modules\EventPengumuman\Http\Controllers\EventPengumumanController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('eventpengumumen', EventPengumumanController::class)->names('eventpengumuman');
});
