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
		// check input if numeric
		if (!is_numeric(Input::get('id')) OR !is_numeric(Input::get('passcode')))
			return Redirect::back()->with('error', 'Numbers only!');

		// check login first
		$voter = Voter::with('semester')->where('id', '=', Input::get('id'))->where('passcode', '=', Input::get('passcode'))->first();
		if (!$voter)
			return Redirect::back()->with('error', 'Wrong Credentials!');

		$voter = $voter->toArray();
		if ($voter['voted'] != NULL)
			return Redirect::back()->with('error', 'This voter has already voted!');

		// get open voting to get the sem_id and campus_id
		$config = Configuration::where('name', '=', 'open_voting')->where('value', '=', $voter['sem_id'])->first();
		if (!$config) // not open for voting
			return Redirect::back()->with('error', 'Voting is closed!');

		// successful
		Session::put('voter', $voter);
		return Redirect::to('/');
	}

	public function logout()
	{
		Session::flush();
		return Redirect::to('/login');
	}
}