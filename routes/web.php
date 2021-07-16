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
        Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('permission:user-edit');
        Route::get('users/{id}/view', 'UserController@view')->name('users.view');
		Route::put('users/{id}', 'UserController@update')->name('users.update')->middleware('permission:user-edit');
		Route::any('users/{id}/destroy', 'UserController@destroy')->name('users.destroy')->middleware('permission:user-delete');
	});

	Route::group(['namespace' => 'Passenger'], function (){
        Route::get('passengers', 'PassengerController@index')->name('passengers.index')->middleware('permission:passenger-list');
        Route::get('passengers/create', 'PassengerController@create')->name('passengers.create')->middleware('permission:passenger-create');
        Route::post('passengers', 'PassengerController@store')->name('passengers.store')->middleware('permission:passenger-create');
        Route::get('passengers/{id}/edit', 'PassengerController@edit')->name('passengers.edit')->middleware('permission:passenger-edit');
        Route::put('passengers/{id}', 'PassengerController@update')->name('passengers.update')->middleware('permission:passenger-edit');
        Route::any('passengers/{id}/destroy', 'PassengerController@destroy')->name('passengers.destroy')->middleware('permission:passenger-delete');
    });

    Route::group(['namespace' => 'Driver'], function (){
        Route::get('drivers', 'DriverController@index')->name('drivers.index')->middleware('permission:driver-list');
        Route::get('drivers/create', 'DriverController@create')->name('drivers.create')->middleware('permission:driver-create');
        Route::post('drivers', 'DriverController@store')->name('drivers.store')->middleware('permission:driver-create');
        Route::get('drivers/{id}/edit', 'DriverController@edit')->name('drivers.edit')->middleware('permission:driver-edit');
        Route::put('drivers/{id}', 'DriverController@update')->name('drivers.update')->middleware('permission:driver-edit');
        Route::any('drivers/{id}/destroy', 'DriverController@destroy')->name('drivers.destroy')->middleware('permission:driver-delete');
        Route::any('drivers/session', 'SessionController@index')->name('drivers.session')->middleware('permission:driver-list');
        Route::get('session/{id}/edit', 'SessionController@edit')->name('session.edit')->middleware('permission:driver-edit');
        Route::post('session/{id}/update', 'SessionController@update')->name('session.update')->middleware('permission:driver-edit');
    });

	Route::group(['namespace' => 'Permission'], function (){
		Route::get('permissions', 'PermissionController@index')->name('permissions.index')->middleware('permission:permission-list');
		Route::get('permissions/create', 'PermissionController@create')->name('permissions.create')->middleware('permission:permission-create');
		Route::post('permissions', 'PermissionController@store')->name('permissions.store')->middleware('permission:permission-create');
		Route::get('permissions/{id}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('permission:permission-edit');
		Route::put('permissions/{id}', 'PermissionController@update')->name('permissions.update')->middleware('permission:permission-edit');
		Route::any('permissions/{id}/destroy', 'PermissionController@destroy')->name('permissions.destroy')->middleware('permission:permission-delete');
	});

	Route::group(['namespace' => 'Rides'], function (){
		Route::get('rides', 'IndexController@index')->name('rides.index')->middleware('permission:ride-list');
		Route::get('rides/accepted', 'IndexController@accepted')->name('rides.accepted')->middleware('permission:ride-list');
		Route::get('rides/completed', 'IndexController@completed')->name('rides.completed')->middleware('permission:ride-list');
		Route::get('rides/cancelled', 'IndexController@cancelled')->name('rides.cancelled')->middleware('permission:ride-list');
		Route::get('rides/{id}', 'IndexController@view')->name('rides.view')->middleware('permission:ride-list');
	});

    Route::group(['namespace' => 'Fares'], function (){
        Route::put('fare/{id}', 'FareController@update')->name('fare.update');
        Route::get('fare/', 'FareController@edit')->name('fare.edit');
    });

    Route::group(['namespace' => 'Commission'], function (){
        Route::put('commission/{id}', 'CommissionController@update')->name('commission.update');
        Route::get('commission/', 'CommissionController@edit')->name('commission.edit');
    });

    Route::group(['namespace' => 'Orders'], function (){
		Route::get('reports/rides', 'OrderController@index')->name('reports.index')->middleware('permission:report-list');
        Route::get('reports/{id}/edit', 'OrderController@edit')->name('reports.edit');
        Route::put('reports/{id}', 'OrderController@update')->name('reports.update');
		Route::post('reports/search', 'OrderController@search')->name('reports.search')->middleware('permission:report-list');
	});

});
