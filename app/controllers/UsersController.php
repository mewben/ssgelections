<?php

class UsersController extends BaseController {

	protected $model;

	public function __construct(User $model)
	{
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Input::get('checklogin'))	return Response::json($this->model->checkLogin(Input::get('pass')), 200);
		else 						return Response::json($this->model->fetch(Input::all()), 200);
	}

	public function login()
	{
		if (Confide::user())	return Redirect::to('/admin');
		else 					return View::make('adminlogin');
	}

	public function postlogin()
	{
		$input = [
			'username' => Input::get('username'),
			'password' => Input::get('password')
		];

		if (Confide::logAttempt($input, true)) { // true for confirmedonly
			if (Confide::user()->status == 'blocked') {
				Confide::logout();
				return Redirect::to('/admin/login')->with('error', 'User Blocked!');
			}
			Utility::getSession();
			return Redirect::intended('/admin');

		} else {
			$user = new User;

			// Check if there was too many login attempts
			if (Confide::isThrottled($input))
				$err = Lang::get('confide::confide.alerts.too_manu_attempts');
			elseif ($user->checkUserExists($input) AND !$user->isConfirmed($input))
				$err = Lang::get('confide::confide.alerts.not_confirmed');
			else
				$err = Lang::get('confide::confide.alerts.wrong_credentials');

			return Redirect::action('UsersController@login')
								->withInput(Input::except('password'))
								->with('error', $err);
		}
	}

	public function logout()
	{
		if (Input::get('w') == 'open_voting' AND Confide::user())
			Configuration::set('open_voting', Session::get('user.sem.id'), Session::get('user.campus.id'));

		Confide::logout();
		Session::flush();

		return Redirect::to('/admin/login');
	}
}