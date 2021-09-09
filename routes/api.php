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

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserPermissionController;
use App\Http\Controllers\API\UserRoleController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AuthGoogle2FAController;
use App\Http\Controllers\API\AuthTwilio2FAController;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('api.login');
    Route::post('register', [AuthController::class, 'register'])->name('api.register');
    Route::post('activate', [UserController::class, 'activate'])->name('api.user.activate');
    Route::middleware(['auth:api'])->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('api.me');
    });
});

include_once('api_groups/multi-factor.php');

Route::prefix('user')->middleware(['auth:api'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::prefix('{user}')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('user.show');
        Route::put('/', [UserController::class, 'update'])->name('user.update');
        Route::delete('/', [UserController::class, 'destroy'])->name('user.destroy');
        Route::prefix('mfa')->group(function () {
            Route::get('g', [AuthGoogle2FAController::class, 'getQRCode'])->name('user.qr.google');
        });
        Route::prefix('role')->group(function () {
            Route::get('/', [UserRoleController::class, 'show'])->name('user.role.show');
            Route::post('/', [UserRoleController::class, 'store'])->name('user.role.store');
            Route::put('/', [UserRoleController::class, 'update'])->name('user.role.update');
            Route::delete('/', [UserRoleController::class, 'destroy'])->name('user.role.destroy');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', [UserPermissionController::class, 'show'])->name('user.permission.show');
            Route::put('/', [UserPermissionController::class, 'update'])->name('user.permission.update');
            Route::post('/', [UserPermissionController::class, 'store'])->name('user.permission.store');
            Route::delete('/', [UserPermissionController::class, 'destroy'])->name('user.permission.destroy');
        });
    });
});
Route::prefix('role')->middleware(['auth:api'])->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('role.index');
    Route::post('/', [RoleController::class, 'store'])->name('role.store');
    Route::prefix('{role}')->group(function () {
        Route::get('/', [RoleController::class, 'show'])->name('role.show');
        Route::put('/', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/', [RoleController::class, 'destroy'])->name('role.destroy');
    });
});
Route::prefix('media')->middleware(['auth:api'])->group(function () {
    Route::get('/', [MediaController::class, 'index'])->name('media.index');
    Route::post('/', [MediaController::class, 'store'])->name('media.store');
    Route::prefix('{media}', function () {
        Route::get('/', [MediaController::class, 'show'])->name('media.show');
        Route::put('/', [MediaController::class, 'update'])->name('media.update');
        Route::delete('/', [MediaController::class, 'destroy'])->name('media.destroy');
    });
});
Route::prefix('option')->middleware(['auth:api'])->group(function () {
    Route::get('/', [OptionController::class, 'index'])->name('option.index');
    Route::post('/', [OptionController::class, 'store'])->name('option.store');
    Route::prefix('{option}')->group(function () {
        Route::get('/', [OptionController::class,  'show'])->name('option.show');
        Route::put('/', [OptionController::class, 'update'])->name('option.update');
        Route::delete('/', [OptionController::class, 'destory'])->name('option.destroy');
    });
});

Route::prefix('category')->middleware(['auth:api'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/', [CategoryController::class, 'store'])->name('category.store');
    Route::prefix('{category}')->group(function () {
        Route::get('/', [CategoryController::class, 'show'])->name('category.show');
        Route::put('/', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});
