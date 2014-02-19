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

Route::get('/', 'BallotsController@index');

// Route::get('/', function()
// {	
// 	if(Session::has('voter')){
// 		$session = Session::get('voter');
// 		$position = Position::with('Candidate')->get();
// 		return View::make('layouts.client', compact('session', 'position'));
// 	}
// 	else
// 	{
// 		return Redirect::to('login');
// 	}
// });

Route::get('login', 'SessionsController@create');
Route::post('login', 'SessionsController@store');
Route::get('logout', 'SessionsController@logout');
Route::resource('sessions', 'SessionsController');

Route::get('que', function()
{
 	$var = Position::with('Candidate')->get();
 	return $var;
});