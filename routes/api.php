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

Route::middleware('auth:api')->prefix('post')->group(function() {
	Route::get('/','API\PostController@all');
	Route::post('/','API\PostController@store');
	Route::get('/{slug}','API\PostController@get');
	Route::put('/{slug}', 'API\PostController@update');
	Route::delete('/{slug}','API\PostController@delete');
});