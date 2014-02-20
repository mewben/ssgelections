<?php

class SessionsController extends BaseController {

	protected $model;

	public function __construct(Voter $model)
	{
		$this->model = $model;
	}

	public function create()
	{
		return View::make('login');
	}

	public function store()
	{
		$input = Input::all();
		$rules = ['id' => 'required', 'passcode' => 'required'];



		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return Redirect::back()->withErrors($validation->messages());
		}
		else {
			$data = Voter::where('id', '=', $input['id'])
						->where('passcode', '=', $input['passcode'])
						->first();

			$session = Voter::where('id', '=', $input['id'])
						->with('semester')
						->first();

			if($data) {
				Session::put('voter', $session->toArray());
				return Redirect::to('/');
			}
			else {
				return Redirect::to('/login');
			}
		}
	}

	public function logout()
	{
		Session::flush();
		return Redirect::to('/login');
	}
}