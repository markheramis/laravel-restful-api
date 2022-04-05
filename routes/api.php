<?php

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Passport\PersonalAccessTokenController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserRoleController;
use App\Http\Controllers\API\UserPermissionController;
use App\Http\Controllers\API\UserMetaController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthTwilio2FAController;

Route::prefix('auth')->middleware('throttle:60,1')->group(function () {
    Route::post('login', [LoginController::class, 'login'])
        ->name('api.login');
    Route::post('register', [RegisterController::class, 'register'])
        ->name('api.register');
    Route::post('activate', [UserController::class, 'activate'])
        ->name('api.user.activate');
    Route::prefix('password')->group(function () {
        Route::post('forgot', [UserController::class, 'forgotPassword'])
            ->name('api.user.password.forgot');
        Route::put('reset', [UserController::class, 'resetPassword'])
            ->name('api.user.password.reset');
    });
    Route::middleware(['auth:api'])->group(function () {
        Route::get('me', [UserController::class, 'me'])
            ->name('api.me');
        Route::post('logout', [LogoutController::class, 'logout'])
            ->name('api.logout');
    });
    Route::prefix('mfa')->group(function () {
        Route::get('settings', [AuthTwilio2FAController::class, 'getSettings'])
            ->middleware('auth:api')
            ->name('api.mfa.twilio.settings');
        Route::get('sms', [AuthTwilio2FAController::class, 'requestTokenSMS'])
            ->middleware('auth:api')
            ->name('api.mfa.twilio.sms');
        Route::post('verify', [AuthTwilio2FAController::class, 'verifyCode'])
            ->middleware(['auth:api'])
            ->name('api.mfa.twilio.verify');
    });
});

Route::prefix('oauth')->middleware(['auth:api'])->group(function () {
    Route::prefix('personal-access-token')->group(function () {
        Route::get('/', [PersonalAccessTokenController::class, 'index'])
            ->name('api.passport.personal.tokens.index');
        Route::post('/', [PersonalAccessTokenController::class, 'store'])
            ->name('api.passport.personal.tokens.store');
        Route::prefix('{token_id}')->group(function () {
            Route::delete('/', [PersonalAccessTokenController::class, 'destroy'])
                ->name('api.passport.personal.tokens.destroy');
        });
    });
});

Route::prefix('user')->middleware(['auth:api', 'mfa.claim'])->group(function () {
    Route::get('/', [UserController::class, 'index'])
        ->name('user.index');
    Route::post('/', [UserController::class, 'store'])
        ->name('user.store');

    Route::put('/mfa', [UserController::class, 'setMFA'])
        ->name('user.mfa.default');
    Route::post('change', [UserController::class, 'changePassword'])
        ->name('user.password.change');
    Route::prefix('{user}')->group(function () {
        Route::get('/', [UserController::class, 'show'])
            ->name('user.show');
        Route::put('/', [UserController::class, 'update'])
            ->name('user.update');
        Route::post('mfa', [UserController::class, 'enable_authy_mfa'])
            ->name('user.mfa.enable');
        Route::delete('mfa', [UserController::class, 'delete_authy_mfa'])
            ->name('user.mfa.delete');
        Route::get('qr', [UserController::class, 'get_qr_code'])
            ->name('user.qr.get');
        Route::delete('/', [UserController::class, 'destroy'])
            ->name('user.destroy');
        Route::prefix('role')->group(function () {
            Route::get('/', [UserRoleController::class, 'show'])
                ->name('user.role.show');
            Route::post('/', [UserRoleController::class, 'store'])
                ->name('user.role.store');
            Route::put('/', [UserRoleController::class, 'update'])
                ->name('user.role.update');
            Route::delete('/', [UserRoleController::class, 'destroy'])
                ->name('user.role.destroy');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', [UserPermissionController::class, 'show'])
                ->name('user.permission.show');
            Route::put('/', [UserPermissionController::class, 'update'])
                ->name('user.permission.update');
            Route::post('/', [UserPermissionController::class, 'store'])
                ->name('user.permission.store');
            Route::delete('/', [UserPermissionController::class, 'destroy'])
                ->name('user.permission.destroy');
        });

        Route::prefix('meta')->group(function () {
            Route::get('/', [UserMetaController::class, 'index'])
                ->name('user.meta.index');
            Route::post('/', [UserMetaController::class, 'store'])
                ->name('user.meta.store');
            Route::prefix('{key}')->group(function () {
                Route::get('/', [UserMetaController::class, 'show'])
                    ->name('user.meta.show');
                Route::put('/', [UserMetaController::class, 'update'])
                    ->name('user.meta.update');
                Route::delete('/', [UserMetaController::class, 'destroy'])
                    ->name('user.meta.destroy');
            });
        });
    });
});
Route::prefix('role')->middleware(['auth:api', 'mfa.claim'])->group(function () {
    Route::get('/', [RoleController::class, 'index'])
        ->name('role.index');
    Route::post('/', [RoleController::class, 'store'])
        ->name('role.store');
    Route::prefix('{role}')->group(function () {
        Route::get('/', [RoleController::class, 'show'])
            ->name('role.show');
        Route::put('/', [RoleController::class, 'update'])
            ->name('role.update');
        Route::delete('/', [RoleController::class, 'destroy'])
            ->name('role.destroy');
    });
});
Route::prefix('permission')->middleware(['auth:api', 'mfa.claim'])->group(function () {
    Route::get('/', [PermissionController::class, 'index'])
        ->name('permission.index');
});
Route::prefix('media')->middleware(['auth:api', 'mfa.claim'])->group(function () {
    Route::get('/', [MediaController::class, 'index'])
        ->name('media.index');
    Route::post('/', [MediaController::class, 'store'])
        ->name('media.store');
    Route::prefix('{media}')->group(function () {
        Route::get('/', [MediaController::class, 'show'])
            ->name('media.show');
        Route::put('/', [MediaController::class, 'update'])
            ->name('media.update');
        Route::delete('/', [MediaController::class, 'destroy'])
            ->name('media.destroy');
        Route::get('/download', [MediaController::class, 'download'])
            ->name('media.download');
    });
});
Route::prefix('option')->middleware(['auth:api', 'mfa.claim'])->group(function () {
    Route::get('/', [OptionController::class, 'index'])
        ->name('option.index');
    Route::post('/', [OptionController::class, 'store'])
        ->name('option.store');
    Route::prefix('{option}')->group(function () {
        Route::get('/', [OptionController::class,  'show'])
            ->name('option.show');
        Route::put('/', [OptionController::class, 'update'])
            ->name('option.update');
        Route::delete('/', [OptionController::class, 'destory'])
            ->name('option.destroy');
    });
});
Route::prefix('category')->middleware(['auth:api', 'mfa.claim'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])
        ->name('category.index');
    Route::post('/', [CategoryController::class, 'store'])
        ->name('category.store');
    Route::prefix('{category}')->group(function () {
        Route::get('/', [CategoryController::class, 'show'])
            ->name('category.show');
        Route::put('/', [CategoryController::class, 'update'])
            ->name('category.update');
        Route::delete('/', [CategoryController::class, 'destroy'])
            ->name('category.destroy');
    });
});
