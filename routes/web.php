<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Auth::routes();
Route::get('/', function () { return redirect('/dashboard');
});


Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => ['auth']], function (){
    Route::get('/', 'DashboardController@index')->name('dashboard');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function(){

	Route::group(['namespace' => 'Role'], function (){
		Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:role-list');
		Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:role-create');
		Route::post('roles', 'RoleController@store')->name('roles.store')->middleware('permission:role-create');
		Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit')->middleware('permission:role-edit');
		Route::put('roles/{id}', 'RoleController@update')->name('roles.update')->middleware('permission:role-edit');
		Route::any('roles/{id}/destroy', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:role-delete');
	});

	Route::group(['namespace' => 'User'], function (){
		Route::get('users', 'UserController@index')->name('users.index')->middleware('permission:user-list');
		Route::get('users/create', 'UserController@create')->name('users.create')->middleware('permission:user-create');
        Route::post('users', 'UserController@store')->name('users.store')->middleware('permission:user-create');
        Route::post('users-change-password', 'UserController@changePassword')->name('users.change.password')->middleware('permission:account-list');
        Route::get('users-password', 'UserController@account')->name('users.password')->middleware('permission:account-list');
		Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('permission:user-edit');
		Route::put('users/{id}', 'UserController@update')->name('users.update')->middleware('permission:user-edit');
		Route::any('users/{id}/destroy', 'UserController@destroy')->name('users.destroy')->middleware('permission:user-delete');
	});

	Route::group(['namespace' => 'Permission'], function (){
		Route::get('permissions', 'PermissionController@index')->name('permissions.index')->middleware('permission:permission-list');
		Route::get('permissions/create', 'PermissionController@create')->name('permissions.create')->middleware('permission:permission-create');
		Route::post('permissions', 'PermissionController@store')->name('permissions.store')->middleware('permission:permission-create');
		Route::get('permissions/{id}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('permission:permission-edit');
		Route::put('permissions/{id}', 'PermissionController@update')->name('permissions.update')->middleware('permission:permission-edit');
		Route::any('permissions/{id}/destroy', 'PermissionController@destroy')->name('permissions.destroy')->middleware('permission:permission-delete');
	});

    Route::group(['namespace' => 'Vendor'], function (){
        Route::get('vendor', 'VendorController@index')->name('vendor.index')->middleware('permission:vendor-list');
        Route::get('vendor/create', 'VendorController@create')->name('vendor.create')->middleware('permission:vendor-create');
        Route::post('vendor', 'VendorController@store')->name('vendor.store')->middleware('permission:vendor-create');
        Route::get('vendor/{id}/edit', 'VendorController@edit')->name('vendor.edit')->middleware('permission:vendor-edit');
        Route::put('vendor/{id}', 'VendorController@update')->name('vendor.update')->middleware('permission:vendor-edit');
        Route::any('vendor/{id}/destroy', 'VendorController@destroy')->name('vendor.destroy')->middleware('permission:vendor-delete');
    });

    Route::group(['namespace' => 'Rider'], function (){
        Route::get('rider', 'RiderController@index')->name('rider.index')->middleware('permission:rider-list');
        Route::get('rider/create', 'RiderController@create')->name('rider.create')->middleware('permission:rider-create');
        Route::post('rider', 'RiderController@store')->name('rider.store')->middleware('permission:rider-create');
        Route::get('rider/{id}/edit', 'RiderController@edit')->name('rider.edit')->middleware('permission:rider-edit');
        Route::put('rider/{id}', 'RiderController@update')->name('rider.update')->middleware('permission:rider-edit');
        Route::put('rider-approve/{id}', 'RiderController@updateApproval')->name('rider.approve');
        Route::put('rider-status/{id}', 'RiderController@updateStatus')->name('rider.status');
        Route::any('rider/{id}/destroy', 'RiderController@destroy')->name('rider.destroy')->middleware('permission:rider-delete');
    });

    Route::group(['namespace' => 'Product'], function (){
        Route::get('product', 'ProductController@index')->name('product.index')->middleware('permission:product-list');
        Route::get('product/create', 'ProductController@create')->name('product.create')->middleware('permission:product-create');
        Route::post('product', 'ProductController@store')->name('product.store')->middleware('permission:product-create');
        Route::get('product/{id}/edit', 'ProductController@edit')->name('product.edit')->middleware('permission:product-edit');
        Route::put('product/{id}', 'ProductController@update')->name('product.update')->middleware('permission:product-edit');
        Route::put('product-status/{id}', 'ProductController@updateStatus')->name('product.status');
        Route::any('product/{id}/destroy', 'ProductController@destroy')->name('product.destroy')->middleware('permission:product-delete');
    });

    Route::group(['namespace' => 'Category'], function (){
        Route::get('category', 'CategoryController@index')->name('category.index')->middleware('permission:category-list');
        Route::get('category/create', 'CategoryController@create')->name('category.create')->middleware('permission:category-create');
        Route::post('category', 'CategoryController@store')->name('category.store')->middleware('permission:category-create');
        Route::get('category/{id}/edit', 'CategoryController@edit')->name('category.edit')->middleware('permission:category-edit');
        Route::put('category/{id}', 'CategoryController@update')->name('category.update')->middleware('permission:category-edit');
        Route::any('category/{id}/destroy', 'CategoryController@destroy')->name('category.destroy')->middleware('permission:category-delete');
    });

    Route::group(['namespace' => 'Shop'], function (){
        Route::get('shop', 'ShopsController@index')->name('shop.index')->middleware('permission:shop-list');
        Route::get('shop/create', 'ShopsController@create')->name('shop.create')->middleware('permission:shop-create');
        Route::post('shop', 'ShopsController@store')->name('shop.store')->middleware('permission:shop-create');
        Route::get('shop/{id}/edit', 'ShopsController@edit')->name('shop.edit')->middleware('permission:shop-edit');
        Route::put('shop/{id}', 'ShopsController@update')->name('shop.update')->middleware('permission:shop-edit');
        Route::put('shop-status/{id}', 'ShopsController@updateStatus')->name('shop.status');
        Route::put('shop-approve/{id}', 'ShopsController@updateApproval')->name('shop.approve');
        Route::any('shop/{id}/destroy', 'ShopsController@destroy')->name('shop.destroy')->middleware('permission:shop-delete');
    });

    Route::group(['namespace' => 'Order'], function (){
        Route::get('order', 'OrdersController@index')->name('order.index')->middleware('permission:order-list');
        Route::get('order/{id}/edit', 'OrdersController@edit')->name('order.edit')->middleware('permission:order-edit');
        Route::put('order/{id}', 'OrdersController@update')->name('order.update')->middleware('permission:order-edit');
        Route::any('order/{id}/destroy', 'OrdersController@destroy')->name('order.destroy')->middleware('permission:order-delete');
    });

    Route::group(['namespace' => 'Rides'], function (){
        Route::get('rides/cancelled', 'RidesController@cancelled')->name('rides.cancelled')->middleware('permission:ride-list');
    });


});
