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
}