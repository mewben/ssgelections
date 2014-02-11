<?php

class SemestersController extends BaseController {

	protected $model;

	public function __construct(Semester $model)
	{
		$this->model = $model;
	}
}