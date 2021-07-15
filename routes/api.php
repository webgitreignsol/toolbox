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


Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {

	Route::group(['prefix' => 'auth'], function() {
        Route::post('login', 'AuthController@login');
        Route::post('sign-up', 'AuthController@signUp');
       
    Route::group(['middleware' => 'auth:api'], function() {
		Route::post('create/profile', 'AuthController@createProfile');
        Route::get('get-profile/{id}','AuthController@getProfile');
		});    

	});

	Route::group(['namespace' => 'Vendor', 'prefix' => 'vendors', 'middleware' => 'auth:api'], function() {

	});

	Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'middleware' => 'auth:api'], function() {


	});

});
