<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Passport\AuthorizationController;
use App\Http\Controllers\API\Passport\ApproveAuthorizationController;
use App\Http\Controllers\API\Passport\DenyAuthorizationController;
use App\Http\Controllers\API\Passport\AccessTokenController;
use App\Http\Controllers\API\Passport\AuthorizedAccessTokenController;
use App\Http\Controllers\API\Passport\TransientTokenController;
use App\Http\Controllers\API\Passport\ClientController;
use App\Http\Controllers\API\Passport\PersonalAccessTokenController;
use App\Http\Controllers\API\Passport\ScopeController;
Route::prefix('authorize')->middleware(['auth:api'])->group(function() {
    Route::get('/', [AuthorizationController::class, 'authorize'])->name('api.passport.authorizations.authorize');
    Route::post('/', [ApproveAuthorizationController::class, 'approve'])->name('api.passport.authorizations.approve');
    Route::delete('/', [DenyAuthorizationController::class, 'deny'])->name('api.passport.authorizations.deny');
});
Route::prefix('clients')->group(function() {
    Route::get('/', [ClientController::class, 'forUser'])->name('api.passport.clients.index');
    Route::post('/', [ClientController::class, 'store'])->name('api.passport.clients.store');
    Route::prefix('{client_id}')->group(function() {
        Route::put('/', [ClientController::class, 'update'])->name('api.passport.clients.update');
        Route::delete('/',[ClientController::class, 'destroy'])->name('api.passport.clients.destroy');
    });
});
Route::prefix('personal-access-tokens')->middleware(['api', 'auth:api'])->group(function() {
    Route::get('/', [PersonalAccessTokenController::class, 'forUser'])->name('api.passport.personal.tokens.index');
    Route::post('/', [PersonalAccessTokenController::class, 'store'])->name('api.passport.personal.tokens.store');
    Route::delete('/{token_id}', [PersonalAccessTokenController::class, 'destroy'])->name('api.passport.personal.tokens.destroy');
});
Route::get('/scopes', [ScopeController::class, 'all'])->name('api.passport.scopes.index');
Route::prefix('token')->group(function() {
    Route::post('/', [AccessTokenController::class, 'issueToken'])->name('api.passport.token');
    Route::post('/refresh', [TransientTokenController::class, 'refresh'])->name('api.passport.token.refresh');
});
Route::prefix('tokens')->middleware(['auth:api'])->group(function() {
    Route::get('/', [AuthorizedAccessTokenController::class, 'forUser'])->name('api.passport.tokens.index');
    Route::delete('/{token_id}', [AuthorizedAccessTokenController::class, 'destroy'])->name('api.passport.tokens.destroy');
});