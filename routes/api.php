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
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserPermissionController;
use App\Http\Controllers\API\UserRoleController;
use App\Http\Controllers\API\RoleController;


Route::get('me', [AuthController::class, 'me'])->middleware(['auth:api'])->name('api.me');
Route::post('login', [AuthController::class, 'login'])->name('api.login');
Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::post('activate', [UserController::class, 'activate'])->name('api.user.activate');

Route::prefix('user')->middleware(['auth:api'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::prefix('{user}')->group(function () {
        Route::get('/', [UserController::class, 'show']);
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'delete']);
        Route::prefix('role')->group(function () {
            Route::get('/', [UserRoleController::class, 'show']);
            Route::post('/', [UserRoleController::class, 'add']);
            Route::delete('/', [UserRoleController::class, 'delete']);
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', [UserPermissionController::class, 'show']);
            Route::put('/', [UserPermissionController::class, 'update']);
            Route::post('/', [UserPermissionController::class, 'add']);
            Route::delete('/', [UserPermissionController::class, 'delete']);
        });
    });
});
Route::prefix('role')->middleware(['auth:api'])->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::prefix('{role}')->group(function () {
        Route::get('/', [RoleController::class, 'show']);
        Route::put('/', [RoleController::class, 'update']);
        Route::delete('/', [RoleController::class, 'delete']);
    });
});

/*
Route::resource('role', RoleController::class)->except(['create', 'edit']);
*/