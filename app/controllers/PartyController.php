<?php

class PartyController extends BaseController {

	protected $model;

	public function __construct(Party $model)
	{
		$this->model = $model;
	}
}