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

});

// logged out user only
Route::group(['before' => 'guest'], function() {
	Route::get('/',                     [                              'uses' => 'UserController@getLoginForm']);

	Route::get('/user/login',           ['as' => 'user.login.form',    'uses' => 'UserController@getLoginForm']);
	Route::get('/user/register',        ['as' => 'user.register.form', 'uses' => 'UserController@getRegisterForm']);

	Route::post('/user/login',          ['as' => 'user.login',         'uses' => 'UserController@postLogin']);
	Route::post('/user/register',       ['as' => 'user.register',      'uses' => 'UserController@postRegister']);
});