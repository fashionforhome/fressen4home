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
	Route::get('/stores/all',           ['as' => 'stores.all',      'uses' => 'StoreController@getAll']);
	Route::get('/store/{id}/dishes',    ['as' => 'store.dishes',    'uses' => 'StoreController@getDishes']);

	Route::get('/user/logout',          ['as' => 'user.logout',     'uses' => 'UserController@getLogout']);

	Route::get('/delivery/create',							['as' => 'delivery.create.form',	'uses' => 'DeliveryController@getCreateForm']);
	Route::post('/delivery/create',							['as' => 'delivery.create',     	'uses' => 'DeliveryController@postCreate']);
	Route::post('/delivery/{deliveryId}/order/{dishId}',    ['as' => 'delivery.order.dish',     'uses' => 'DeliveryController@postAddOrder']);
	Route::get('/delivery/{id}/dishes',                     ['as' => 'delivery.store.dishes',   'uses' => 'DeliveryController@getStoreDishes']);
	Route::get('/deliveries/active',                        ['as' => 'deliveries.active',       'uses' => 'DeliveryController@getOverviewOfActive']);
	Route::get('/delivery/{id}',                            ['as' => 'delivery.order.overview', 'uses' => 'DeliveryController@getOrderOverview']);

	Route::post('/order/{id}/change/paid',          ['as' => 'order.change.paid',  'uses' => 'OrderController@postChangePaid']);
	Route::post('/order/{orderId}/delete',          ['as' => 'order.delete',       'uses' => 'OrderController@postDelete']);
});

// logged out user only
Route::group(['before' => 'guest'], function() {
	Route::get('/',                     [                               'uses' => 'UserController@getLoginForm']);

	Route::get('/user/login',           ['as' => 'user.login.form',     'uses' => 'UserController@getLoginForm']);
	Route::get('/user/register',        ['as' => 'user.register.form',  'uses' => 'UserController@getRegisterForm']);

	Route::post('/user/login',          ['as' => 'user.login',          'uses' => 'UserController@postLogin']);
	Route::post('/user/register',       ['as' => 'user.register',       'uses' => 'UserController@postRegister']);
});
