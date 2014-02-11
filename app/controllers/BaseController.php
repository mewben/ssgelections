<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Input::get('list'))		return Response::json($this->model->getList(), 200);
		else 						return Response::json($this->model->fetch(Input::all()), 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Response::json($this->model->store(Input::all()), 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!is_numeric($id))	throw new Exception('Please enter a number.', 409);

		return Response::json($this->model->store(Input::all(), $id), 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (!is_numeric($id))	throw new Exception('Please enter a number.', 409);

		return Response::json($this->model->remove($id, Input::get('force')), 200);
	}
}