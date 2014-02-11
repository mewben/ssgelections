<?php

class CampusesController extends BaseController {

	protected $model;

	public function __construct(Campus $model)
	{
		$this->model = $model;
	}
}