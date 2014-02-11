<?php

class CollegesController extends BaseController {

	protected $model;

	public function __construct(College $model)
	{
		$this->model = $model;
	}
}