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

// API V1
Route::group(array('prefix' => 'api/v1', 'before' => 'auth'), function() {

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
	Route::get('results', 'UtilityController@results'); // when accessed from admin
});


// ADMIN
Route::get('/admin/logout', function() {
	if (Input::get('w') == 'open_voting' AND Confide::user())
		Configuration::set('open_voting', Session::get('user.sem.id'), Session::get('user.campus.id'));

	Confide::logout();
	Session::flush();

	return Redirect::to('/');
});
Route::get('/admin/{path?}', array('before' => 'auth|closedvoting', function ($path = null) {

	$session = Session::get('user');
	return View::make('layouts.admin', compact('session'));

}))->where('path', '.*');


// ETC
Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@logout');
Route::resource('sessions', 'SessionsController');

Route::get('/ongoing', function()
{
	return View::make('ongoing');
});
Route::get('/success', function() {
	return View::make('success');
});
Route::any('/close-voting', 'UtilityController@closeVoting');
Route::get('/results', 'UtilityController@results');

Route::group(array('before' => 'voterloggedin'), function() {

	Route::get('/', 'BallotsController@index');
	Route::post('/cast', 'BallotsController@cast');

});



Route::get('/test', function() {
	//if (App::environment('production')) 	return Redirect::to('/admin');

	Confide::logout();
	Session::flush();
	Auth::loginUsingId(1);
	Utility::getSession();
	return Redirect::to('/admin');
});