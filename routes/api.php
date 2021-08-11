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
        Route::group(['prefix' => 'customer','namespace' => 'Customer'], function() {
            Route::post('login', 'AuthController@login');
            Route::post('forgot-password', 'AuthController@forgotPassword');
            Route::post('update-password', 'AuthController@updatePassword');
            Route::post('sign-up', 'AuthController@signUp');
            Route::post('check-otp', 'AuthController@checkOtp');
            Route::post('verify-otp', 'AuthController@verifyOtp');
            Route::post('resend-otp', 'AuthController@resendOtp');
            Route::post('facebook-login', 'AuthController@facebookSignIn');
            Route::post('google-login', 'AuthController@googleSignIn');
            Route::post('apple-login', 'AuthController@appleSignIn');


            Route::group(['middleware' => 'auth:api'], function() {
                Route::post('create-profile', 'AuthController@createProfile');
                Route::post('update-profile', 'AuthController@updateProfile');
                Route::get('get-profile','AuthController@getProfile');
                Route::post('sign-out','AuthController@signOut');
                Route::post('change-password','AuthController@changePassword');
                Route::post('create-rider-rating','AuthController@CreateRiderRatings');


                Route::get('get-wishlist','WishlistController@getWishlist');
                Route::get('remove-wishlist/{id}','WishlistController@removeWishlist');
                Route::post('create-wishlist','WishlistController@store');

                Route::get('get-user-address','AddressController@getUserAddress');
                Route::post('create-address','AddressController@store');
                Route::post('update-address/{id}','AddressController@update');


                Route::get('get-all-product','ProductController@getAllProducts');
                Route::post('create-product-rating','ProductController@ProductRating');
                Route::post('search-products','ProductController@search');

                Route::get('get-all-shop','ShopsController@getAllShops');
                Route::post('create-shop-rating','ShopsController@ShopRating');



                Route::get('get-order-process','OrderController@getProcessOrders');
                Route::get('get-order-delivered','OrderController@getDeliveredOrders');


            });
        });

        Route::group(['prefix' => 'rider','namespace' => 'Rider'], function() {
            Route::post('login', 'AuthController@login');
            Route::post('forgot-password', 'AuthController@forgotPassword');
            Route::post('update-password', 'AuthController@updatePassword');
            Route::post('sign-up', 'AuthController@signUp');
            Route::post('check-otp', 'AuthController@checkOtp');
            Route::post('verify-otp', 'AuthController@verifyOtp');
            Route::post('resend-otp', 'AuthController@resendOtp');

            Route::group(['middleware' => 'auth:api'], function() {
                Route::post('update-profile', 'AuthController@updateProfile');
                Route::get('get-profile','AuthController@getProfile');
                Route::post('sign-out','AuthController@signOut');
                Route::post('change-password','AuthController@changePassword');


                // Bank Detail
                Route::get('get-bank-detail','BankDetailController@getBankDetail');
                Route::post('update-bank-detail','BankDetailController@updateBankDetail');

                // Rider Trips
                Route::get('trip-req/{id}', 'RiderController@TripReq');
                Route::get('my-trips', 'RiderController@getAlltrips');
                Route::get('scheduled-trips', 'RiderController@getScheduledtrips');
                Route::get('accepted-ride', 'RiderController@RideAccepted');
                Route::post('ride-status/{id}', 'RiderController@rideStatus');

                // Rider Earning
                Route::get('rider-earning', 'OrderController@riderEarning');
                Route::post('search-rider-earning', 'OrderController@search');
            });
        });

    });
});
