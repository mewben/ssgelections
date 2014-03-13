<?php

class BallotsController extends BaseController {

	protected $model;

	public function __construct(Ballot $model)
	{
		$this->model = $model;
	}

	public function index()
	{
		$voter = Voter::with('semester')->where('voter_id', '=', 181068)->where('passcode', '=', 958180)->first();
		
		$voter = $voter->toArray();
		
		// get open voting to get the sem_id and campus_id
		
		// successful
		Session::put('voter', $voter);


		$session = Session::get('voter');
		$options = Ballot::getOptions();

		return View::make('cast', compact('options', 'session'));
	}

	public function cast()
	{
		return Response::json(Ballot::cast(Input::all()), 200);
	}
}