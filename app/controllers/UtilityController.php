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
		return Voter::export();
	}

	public function count()
	{
		if(Input::get('count')) {
			return Voter::count();
		}
	}
}