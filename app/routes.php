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

Route::get('/test', function() {
	if (App::environment('production')) 	return Redirect::to('/admin');

	Confide::logout();
	Session::flush();
	Auth::loginUsingId(1);
	//Iss\Session::get();
	return Redirect::to('/admin');
});

Route::get('/admin/{path?}', array('before' => 'auth', function ($path = null) {

	//$session = Iss\Session::get();
	$session = null;
	return View::make('layouts.admin', compact('session'));

}))->where('path', '.*');


Route::get('/', function()
{
	return View::make('hello');
});