<?php

class Role extends Eloquent {

	protected $table = 'roles';
	protected $softDelete = true;

	public static $rules = [
		'name' => 'required',
		'desc' => 'max:225'
	];

	public function setNameAttribute($value)
	{
		$this->attribute['name'] = strtolower($value);
	}

	public function getList($json = null)
	{
		$model = new static;

		$model = $model->whereNull('status');

		// exclude superadmin from result if not superadmin
		if(!Confide::user()->hasRole('superadmin'))
			$model = $model->where('name', '!=', 'superadmin');

		$model = $model->orderBy('name');
		$result['data'] = $model->get(array('id', 'name'))->toArray();
		return $result;
	}
}