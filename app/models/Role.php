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
}