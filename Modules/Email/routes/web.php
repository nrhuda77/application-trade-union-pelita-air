<?php

use Illuminate\Support\Facades\Route;
use Modules\Email\Http\Controllers\EmailController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('emails', EmailController::class)->names('email');
});
