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

	// user related
	Route::get('/user/logout',                              ['as' => 'user.logout',             'uses' => 'UserController@getLogout']);
    Route::get('/user/deliveries',                          ['as' => 'user.deliveries',         'uses' => 'UserController@getUserDeliveries']);
    Route::get('/user/orders',                              ['as' => 'user.orders',             'uses' => 'UserController@getUserOrders']);
    Route::get('/user/statistics',                          ['as' => 'user.statistics',         'uses' => 'UserController@getStatistics']);

	// store overview
	Route::get('/store/all',                                ['as' => 'store.all',               'uses' => 'StoreController@getAll']);
	Route::get('/store/{id}/dishes',                        ['as' => 'store.dishes',            'uses' => 'StoreController@getDishes']);

	// delivery
	Route::get('/delivery/active',                          ['as' => 'delivery.active',         'uses' => 'DeliveryController@getOverviewOfActive']);
	Route::get('/delivery/{id}/dishes',                     ['as' => 'delivery.store.dishes',   'uses' => 'DeliveryController@getStoreDishes']);
	Route::get('/delivery/{id}',                            ['as' => 'delivery.overview',       'uses' => 'DeliveryController@getOverview']);

	Route::post('/delivery/create',							['as' => 'delivery.create',     	'uses' => 'DeliveryController@postCreate']);
	Route::post('/delivery/{deliveryId}/order/{dishId}',    ['as' => 'delivery.order.dish',     'uses' => 'DeliveryController@postAddOrder']);
	Route::post('/delivery/{deliveryId}/delete',			['as' => 'delivery.delete',     	'uses' => 'DeliveryController@postDelete']);
	Route::post('/delivery/{deliveryId}/close',			    ['as' => 'delivery.close',     	    'uses' => 'DeliveryController@postClose']);

	Route::get('/delivery/{deliveryId}/incoming',		    ['as' => 'delivery.incoming',     	'uses' => 'DeliveryController@getIncoming']);

	// orders
	Route::post('/order/{id}/change/paid',                  ['as' => 'order.change.paid',       'uses' => 'OrderController@postChangePaid']);
	Route::post('/order/{orderId}/delete',                  ['as' => 'order.delete',            'uses' => 'OrderController@postDelete']);

    // configs
	Route::get('/configs',                                  ['as' => 'configs.all',             'uses' => 'ConfigsController@getAll']);
	Route::post('/configs',                                 ['as' => 'configs.save',            'uses' => 'ConfigsController@postSave']);

});


// logged out user only
Route::group(['before' => 'guest'], function() {

	// guest landing page
	Route::get('/',                     [                               'uses' => 'UserController@getLoginForm']);

	// user related
	Route::get('/user/login',           ['as' => 'user.login.form',     'uses' => 'UserController@getLoginForm']);
	Route::get('/user/register',        ['as' => 'user.register.form',  'uses' => 'UserController@getRegisterForm']);

	Route::post('/user/login',          ['as' => 'user.login',          'uses' => 'UserController@postLogin']);
	Route::post('/user/register',       ['as' => 'user.register',       'uses' => 'UserController@postRegister']);

});
