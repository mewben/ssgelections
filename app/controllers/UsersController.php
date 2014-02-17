<?php

class UsersController extends BaseController {

	protected $model;

	public function __construct(User $model)
	{
		$this->model = $model;
	}
}