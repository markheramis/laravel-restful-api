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
Route::get('activate/{id}/{code}','API\UserController@activate');

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

	Route::get		('/{slug}/role',	'API\UserController@get_role');
	Route::post		('/{slug}/role', 	'API\UserController@add_role');
	Route::delete ('/{slug}/role', 	'API\UserController@remove_role');

	Route::get		('/{slug}/permission',	'API\UserController@get_permission');
	Route::post		('/{slug}/permission',	'API\UserController@add_permission');
	Route::put		('/{slug}/permission',	'API\UserController@update_permission');
	Route::delete	('/{slug}/permission',	'API\UserController@remove_permission');
});
