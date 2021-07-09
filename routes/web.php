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

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', function () {
		return redirect('/dashboard');
	});

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => ['auth']], function (){
		Route::get('/', 'DashboardController@index')->name('dashboard');		
});	

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function(){

	Route::get('/', function () {
		return redirect('/dashobard');
	});
	
	
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

});
