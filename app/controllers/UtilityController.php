<?php

class UtilityController extends BaseController {

	public function setSession()
	{
		Utility::setSession(Input::all());
		return Redirect::intended('/admin');
	}

	public function import()
	{
		try {
			Voter::import();
		} catch (Exception $e) {
			return Redirect::to('/admin/voters')->with('errors', 'Database error! Check your data.');
		}

		Session::flash('info', "Import successful!");
		return Redirect::to('/admin/voters');
	}

	public function store()
	{
		if (Input::get('generate')) { // generate pass Codes
			Voter::generate();
		}

		return Response::json('1', 200);
	}

	public function export()
	{
		$data = Voter::getAll();

		return Voter::export($data);
	}

	public function printWhat()
	{
		$session = Session::get('user');

		if (Input::get('w') == 'initial') {// print initial report
			$data = Ballot::getResults();
			$passcode1 = Configuration::get('close_passcode_1', Session::get('user.campus.id'));
			$passcode2 = Configuration::get('close_passcode_2', Session::get('user.campus.id'));
			return View::make('print.initial', compact('data', 'session', 'passcode1', 'passcode2'));
		}

		$data = Voter::getAll();
		return View::make('print.voters', compact('data', 'session'));
	}

	public function count()
	{
		if(Input::get('count')) {
			return Voter::count();
		}
	}

	/**
	 * Re-zero and initalize
	 */
	public function initialize()
	{
		return Response::json(Ballot::initialize(), 200);
	}

	public function changePassword()
	{
		return Response::json(User::changePassword(Input::all()), 200);
	}
}