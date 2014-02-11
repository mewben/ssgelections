<?php

class PartylistsController extends BaseController {

	protected $model;

	public function __construct(Partylist $model)
	{
		$this->model = $model;
	}
}