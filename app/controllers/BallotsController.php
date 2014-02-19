<?php

class BallotsController extends BaseController {

	protected $model;

	public function __construct(Ballot $model)
	{
		$this->model = $model;
	}

	public function index()
	{
		if(Session::has('voter')){
			$session = Session::get('voter');
			$options = Ballot::getOptions();
			return View::make('client', compact('session', 'options'));
		}
		else
		{
			return Redirect::to('login');
		}
	}
}