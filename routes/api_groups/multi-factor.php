<?php

use App\Http\Controllers\API\AuthGoogle2FAController;
use App\Http\Controllers\API\AuthTwilio2FAController;


Route::prefix('auth')->group(function () {
    Route::middleware(['auth:api'])->group(function () {
        Route::prefix('mfa')->group(function () {
            // Google MFA Route Group
            Route::prefix('g')->group(function () {
                Route::get('isAuthenticated', [AuthGoogle2FAController::class, 'isAuthenticated'])->name('api.mfa.google.auth');
                Route::prefix('{user}')->group(function () {
                    Route::post('verify', [AuthGoogle2FAController::class, 'verifyCode'])->name('api.mfa.google.verify');
                });
            });
            // Twilio MFA Route Group
            Route::prefix('t')->group(function () {
                Route::get('isAuthenticated', [AuthTwilio2FAController::class, 'isAuthenticated'])->name('api.mfa.twilio.auth');
                Route::post('verify', [AuthTwilio2FAController::class, 'verifyCode'])->name('api.mfa.twilio.verify');
            });
        });
    });
});
