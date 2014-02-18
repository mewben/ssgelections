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
	Route::resource('party', 'PartyController');
	Route::resource('positions', 'PositionsController');
	Route::resource('roles', 'RolesController');
	Route::resource('semesters', 'SemestersController');
	Route::resource('users', 'UsersController');

	Route::post('sessions', 'UtilityController@setSession');
	Route::post('import', 'UtilityController@import');
	Route::post('voters', 'UtilityController@store');
	Route::get('voters', 'UtilityController@count');
	Route::get('export', 'UtilityController@export');
	Route::get('print', 'UtilityController@printWhat');
	Route::get('initialize', 'UtilityController@initialize');
	Route::post('change_password', 'UtilityController@changePassword');
});

Route::post('/import', function() {
	$m = Excel::load(Input::file('file')->getRealPath())->toArray();
	print_r($m);
	dd();
	//Excel::load()
});

Route::get('test2', function() {
	echo mt_rand(123456, 987654);
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
	return Redirect::to('/login');
});

Route::get('login', function()
{
	return View::make('login');
});
Route::post('login', 'BallotController@postLogin');

Route::get('vote', function()
{
 	return View::make('layouts.ballot');
});