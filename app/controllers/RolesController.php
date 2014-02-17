<?php

class RolesController extends BaseController {

	protected $model;

	public function __construct(Role $model)
	{
		$this->model = $model;
	}

}