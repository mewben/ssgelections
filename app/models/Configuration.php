<?php

class Configuration extends BaseModel {

	protected $table = 'config';
	protected $fillable = ['name', 'value', 'campus_id'];
	public $timestamps = true;

	public static $rules = [
		'name' => 'required|max:255'
	];


	/**
	 * Set or update a configuration value
	 */
	public static function set($name, $value = NULL, $campus_id)
	{
		if (!$model = static::where('name', '=', $name)->where('campus_id', '=', $campus_id)->first())
			$model = new static;

		$model->name = e(trim(strtolower($name)));
		$model->value = e(trim($value));
		$model->campus_id = $campus_id;
		$model->save();

		return $model;
	}

	/**
	 * Get a configuration value
	 */
	public static function get($name, $campus_id)
	{
		return static::where('name', '=', $name)->where('campus_id', '=', $campus_id)->first();
	}
}