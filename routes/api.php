<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
	Route::post('login','AuthController@login');
	Route::post('register','AuthController@register');
	//category controller
	Route::get('categories','CategoryController@index');
	Route::get('categories/random/{count}','CategoryController@random');
	Route::get('categories/slug/{slug}','CategoryController@slug');
	//fashion controller
	Route::get('fashions','FashionController@index');
	Route::get('fashions/top/{count}','FashionController@top');
	Route::get('fashions/slug/{slug}','FashionController@slug');
	Route::get('fashions/search/{keyword}','FashionController@search');
	Route::get('fashion/{id}','FashionController@view')->where('id','[0-9]+');

	Route::middleware('auth:api')->group(function(){
		Route::post('logout','AuthController@logout');
	});
});
