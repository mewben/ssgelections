<?php

class PositionsController extends BaseController {

	protected $model;

	public function __construct(Position $model)
	{
		$this->model = $model;
	}
}