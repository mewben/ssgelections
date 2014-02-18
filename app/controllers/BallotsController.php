<?php 

Class BallotsController extends BaseController {
	protected $model;

	public function __construct(Ballot $model)
	{
		$this->model = $model;
	}
}

 ?>