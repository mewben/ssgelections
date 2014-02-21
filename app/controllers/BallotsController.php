<?php

class BallotsController extends BaseController {

	protected $model;

	public function __construct(Ballot $model)
	{
		$this->model = $model;
	}

	public function index()
	{
		$session = Session::get('voter');
		$options = Ballot::getOptions();

		return View::make('cast', compact('options', 'session'));
	}

	public function cast()
	{
		return Response::json(Ballot::cast(Input::all()), 200);
	}
}