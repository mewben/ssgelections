<?php

class Campus extends BaseModel {

	protected $table = 'campuses';
	protected $softDelete = true;
	protected $fillable = ['name', 'address', 'color', 'status'];
	public $timestamps = false;

	public static $rules = [
		'name' => 'required',
		'address' => 'max:255',
		'color' => 'max:7'
	];

	public function getList()
	{
		$model = new static;

		$model = $model->whereNull('status');
		$model = $model->orderBy('name');

		return $model->lists('name', 'id');
	}
}