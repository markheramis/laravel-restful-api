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
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('activate/{slug}/{code}','API\UserController@activate');
Route::get('/me', 'API\UserController@me')->middleware('auth:api');

Route::middleware('auth:api')->prefix('post')->group(function() {
	Route::get		('/',					'API\PostController@all');
	Route::post		('/',					'API\PostController@store');
	Route::get		('/{slug}',		'API\PostController@get');
	Route::put		('/{slug}', 	'API\PostController@update');
	Route::delete	('/{slug}',		'API\PostController@delete');
});

Route::middleware('auth:api')->prefix('user')->group(function() {
	Route::get		('/', 				'API\UserController@all');
	Route::get		('/{slug}', 	'API\UserController@get');
	Route::put		('/{slug}', 	'API\UserController@update');
	Route::delete	('/{slug}', 	'API\UserController@delete');

	Route::get		('/{slug}/role',	'API\UserRoleController@get');
	Route::post		('/{slug}/role', 	'API\UserRoleController@add');
	Route::delete 	('/{slug}/role', 	'API\UserRoleController@delete');

	Route::get		('/{slug}/permission',	'API\UserPermissionController@get');
	Route::post		('/{slug}/permission',	'API\UserPermissionController@add');
	Route::put		('/{slug}/permission',	'API\UserPermissionController@update');
	Route::delete	('/{slug}/permission',	'API\UserPermissionController@delete');
});
