<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// routes for logged in user
Route::group(['before' => 'auth'], function() {
	Route::get('/stores/all',           ['as' => 'stores.all',              'uses' => 'StoreController@getAll']);
	Route::get('/store/{id}/dishes',    ['as' => 'store.dishes',            'uses' => 'StoreController@getDishes']);

	Route::get('/user/logout',          ['as' => 'user.logout',             'uses' => 'UserController@getLogout']);

	Route::post('/delivery/{deliveryId}/order/{dishId}',    ['as' => 'delivery.order.dish',     'uses' => 'DeliveryController@postAddOrder']);
	Route::get('/delivery/{id}/dishes',                     ['as' => 'delivery.store.dishes',   'uses' => 'DeliveryController@getStoreDishes']);
});

// logged out user only
Route::group(['before' => 'guest'], function() {
	Route::get('/',                     [                               'uses' => 'UserController@getLoginForm']);

	Route::get('/user/login',           ['as' => 'user.login.form',     'uses' => 'UserController@getLoginForm']);
	Route::get('/user/register',        ['as' => 'user.register.form',  'uses' => 'UserController@getRegisterForm']);

	Route::post('/user/login',          ['as' => 'user.login',          'uses' => 'UserController@postLogin']);
	Route::post('/user/register',       ['as' => 'user.register',       'uses' => 'UserController@postRegister']);
});
