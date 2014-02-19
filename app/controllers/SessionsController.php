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

		$data = Voter::where('id', '=', $input['id'])
						->where('passcode', '=', $input['passcode'])
						->first();

		$validation = Validator::make($input, $rules);
		if($validation->fails())
		{
			return Redirect::to('/login');
		}
		elseif($data)
		{
			Session::put('voter', $data->toArray());
			return Redirect::to('/');
		}
	}

	public function logout()
	{
		Session::flush();
		return Redirect::to('/login');
	}
}