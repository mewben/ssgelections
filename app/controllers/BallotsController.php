<?php

class BallotsController extends BaseController {

	protected $model;

	public function __construct(Ballot $model)
	{
		$this->model = $model;
	}

	public function index()
	{
		return View::make('cast', compact('session', 'positions'));
		if(Session::has('voter')){
			$session = Session::get('voter');
			$positions = Position::with('Candidate')->get()->toArray();
			return View::make('layouts.client', compact('session', 'positions'));
		}
		else
		{
			return Redirect::to('login');
		}
	}
}