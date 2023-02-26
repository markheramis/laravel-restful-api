<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Passport\AuthorizationController;
use App\Http\Controllers\API\Passport\ApproveAuthorizationController;
use App\Http\Controllers\API\Passport\DenyAuthorizationController;
use App\Http\Controllers\API\Passport\AccessTokenController;
use App\Http\Controllers\API\Passport\AuthorizedAccessTokenController;
Route::prefix('authorize')
    ->middleware(['api','auth:api'])
    ->group(function() {
        Route::get('/', [AuthorizationController::class, 'authorize'])
            ->name('api.passport.authorizations.authorize');
        Route::post('/', [ApproveAuthorizationController::class, 'approve'])
            ->name('api.passport.authorizations.approve');
        Route::delete('/', [DenyAuthorizationController::class, 'deny'])
            ->name('api.passport.authorizations.deny');
    });
Route::post('token', [AccessTokenController::class, 'issueToken'])
    ->middleware('throttle')
    ->name('api.passport.token');
Route::prefix('tokens')
->middleware(['api','auth:api'])
->group(function() {
    Route::get('/', [AuthorizedAccessTokenController::class, 'forUser'])
        ->name('api.passport.tokens.index');
    Route::delete('/{token_id}', [AuthorizedAccessTokenController::class, 'destroy'])
        ->name('api.passport.tokens.destroy');
});