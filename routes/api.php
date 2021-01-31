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

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserPermissionController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserRoleController;

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::post('activate', [UserController::class, 'activate'])->name('api.user.activate');
Route::get('me', [UserController::class, 'me'])->middleware('auth:api')->name('api.me');

Route::group([
    'prefix' => 'post',
    'middleware' => [
        'api',
        'auth:api'
    ]
], function () {
    Route::get('/', [PostController::class, 'all']);
    Route::post('/', [PostController::class, 'store']);
    Route::group(['prefix' => '{slug}'], function () {
        Route::get('/', [PostController::class, 'get']);
        Route::put('/', [PostController::class, 'update']);
        Route::delete('/', [PostController::class, 'delete']);
    });
});

Route::group([
    'prefix' => 'user',
    'middleware' => [
        'api',
        'auth:api',
    ]
], function () {
    Route::get('/', [UserController::class, 'all'])->name('api.user.all');
    Route::group(['prefix' => '{slug}'], function () {
        Route::get('/', [UserController::class, 'get']);
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'delete']);

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [UserRoleController::class, 'get']);
            Route::post('/', [UserRoleController::class, 'add']);
            Route::delete('/', [UserRoleController::class, 'delete']);
        });

        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', [UserPermissionController::class, 'get']);
            Route::put('/', [UserPermissionController::class, 'update']);
            Route::post('/', [UserPermissionController::class, 'add']);
            Route::delete('/', [UserPermissionController::class, 'delete']);
        });
    });
});
