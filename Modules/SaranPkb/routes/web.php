<?php

use Illuminate\Support\Facades\Route;
use Modules\SaranPkb\Http\Controllers\SaranPkbController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('saranpkbs', SaranPkbController::class)->names('saranpkb');
});
