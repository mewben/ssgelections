<?php

class CandidatesController extends BaseController {

	protected $model;

	public function __construct(Candidate $model)
	{
		$this->model = $model;
	}
}