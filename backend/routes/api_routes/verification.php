<?php

use App\Http\Controllers\api\Verification\VerificationController;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Route;

Route::controller(VerificationController::class)
->prefix('/verification')
->group(function () {
    Route::post('/verify-email', 'verifyCode')->name('verification.email');
    Route::post('/resend-code', 'resendCode')->name('verification.resend');
});
