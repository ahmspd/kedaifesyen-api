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
	Route::get('fashion','FashionController@Qbuild');

	//Shop Controller
	Route::get('provinces','ShopController@provinces');
	Route::get('cities','ShopController@cities');
	Route::get('couriers','ShopController@couriers');
	
	Route::middleware('auth:api')->group(function(){
		Route::post('logout','AuthController@logout');
		Route::post('update-profile','AuthController@update_profile');
		Route::post('shipping','ShopController@shipping');
		Route::post('services','ShopController@services');
		Route::get('my-order','ShopController@myorder');
		Route::post('payment','ShopController@payment');
		Route::post('edit-image','AuthController@edit_image');
		Route::get('order/detail/{invoice}','ShopController@detail_order');
	});
});
