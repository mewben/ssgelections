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

Route::group(array('prefix' => 'api/v1', 'before' => ''), function() {

	Route::resource('campuses', 'CampusesController');
	Route::resource('candidates', 'CandidatesController');
	Route::resource('colleges', 'CollegesController');
	Route::resource('partylists', 'PartylistsController');
	Route::resource('positions', 'PositionsController');
	Route::resource('semesters', 'SemestersController');

	Route::post('sessions', 'BaseController@setSession');

});

Route::get('/test', function() {
	if (App::environment('production')) 	return Redirect::to('/admin');

	Confide::logout();
	Session::flush();
	Auth::loginUsingId(1);
	Utility::getSession();
	return Redirect::to('/admin');
});

Route::get('/admin/{path?}', array('before' => 'auth', function ($path = null) {

	//$session = Iss\Session::get();
	$session = Session::get('user');
	return View::make('layouts.admin', compact('session'));

}))->where('path', '.*');


Route::get('/', function()
{
	return View::make('hello');
});