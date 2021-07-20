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
        Route::post('forgot-password', 'AuthController@forgotPassword');
        Route::post('sign-up', 'AuthController@signUp');
        Route::post('check-otp', 'AuthController@checkOtp');
        Route::post('verify-otp', 'AuthController@verifyOtp');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('create/profile', 'AuthController@createProfile');
        Route::post('update/profile/{id}', 'AuthController@updateProfile');
        Route::get('get-profile/{id}','AuthController@getProfile');
        Route::post('sign-out','AuthController@signOut');
        Route::post('change-password','AuthController@changePassword');
        Route::get('my-trips', 'DriverController@getAlltrips');
		});
	});

    Route::group(['namespace' => 'Vendor', 'prefix' => 'vendors', 'middleware' => 'auth:api'], function() {
        Route::get('driver/details', 'DriverController@index');
        Route::post('store/details', 'DriverController@store');
        Route::post('update/details', 'DriverController@update');
        Route::post('get-drivers-around', 'DriverController@getDriversAroud');
    });

	Route::group(['namespace' => 'Customer', 'prefix' => 'customer', 'middleware' => 'auth:api'], function() {
        Route::post('ratings', 'IndexController@ratings');
        Route::get('my-trips', 'IndexController@getAlltrips');
        Route::post('create-address', 'AddressController@store');
        Route::post('update-address/{id}', 'AddressController@update');
        Route::get('get-address', 'AddressController@getUserAddress');
        Route::get('get-alladdress', 'AddressController@index');
	});

});
