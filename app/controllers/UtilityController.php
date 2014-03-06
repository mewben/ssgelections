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
			//return $e->getMessage();
			return Response::json($e->getMessage());
			//return Redirect::to('/admin/voters')->with('errors', 'Database error! Check your data.');
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

		Session::put('user.count', Voter::count());
		Session::put('user.date', date('Y-m-d H:i:s'));
		$session = Session::get('user');

		if (Input::get('w') == 'voted') {
			$data = Voter::where('sem_id', '=', Session::get('user.sem.id'))
					->where('voted', '=', true)
					->orderBy('lname')
					->get()->toArray();
			return View::make('print.voted', compact('data', 'session'));
		}

		if (Input::get('w') == 'notvoted') {
			$data = Voter::where('sem_id', '=', Session::get('user.sem.id'))
					->whereNull('voted')
					->orderBy('lname')
					->get()->toArray();
			return View::make('print.notvoted', compact('data', 'session'));
		}

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

	public function closeVoting()
	{
		if(!($campus_id = Input::get('cid') AND $sem_id = Input::get('sid')))		throw new Exception("Invalid Codes.", 409);

		if (Request::isMethod('get')) { //display close voting form
			return View::make('closevoting', compact('campus_id', 'sem_id'));
		} else {
			return Response::json(Ballot::closeVoting(Input::all(), $campus_id, $sem_id), 200);
		}

	}

	// results
	public function results()
	{
		if(!Session::has('user.campus') OR ! Session::has('user.sem'))
			throw new Exception("No Campus Or Semester Valid!", 400);

		if(Configuration::where('name', '=', 'open_voting')->where('campus_id', '=', Session::get('user.campus.id'))->first())
			throw new Exception("Voting is not closed yet.. You can't view the results.", 400);

		Session::put('user.count', Voter::count());
		Session::put('user.date', date('Y-m-d H:i:s'));
		$session = Session::get('user');
		$data = Ballot::getResults();

		if (Request::ajax())	return Response::json($data = array('data' => $data, 'session' => $session), 200);

		if(Input::get('w') == 'print') { // print results
			return View::make('print.results', compact('session', 'data'));
		} else {
			return View::make('results', compact('session'));
		}
	}
}