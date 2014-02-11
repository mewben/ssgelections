<?php

class Semester extends BaseModel {

	protected $table = 'semesters';
	protected $softDelete = true;
	protected $fillable = ['sy', 'sem', 'campus_id', 'status'];
	public $timestamps = false;

	public static $rules = [
		'sy' => 'required|integer',
		'sem' => 'required|max:1'
	];

	public function current()
	{
		return $this->hasOne('Configuration', 'value')->where('campus_id', '=', Session::get('user.campus.id'));
	}

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$with = ['current'];
		$where = [['campus_id', '=', Session::get('user.campus.id')]];
		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		$data['campus_id'] = Session::get('user.campus.id');
		$return = parent::store($data, $id);

		if (isset($data['current']))	Configuration::set('current_semester', $return['id'], $data['campus_id']);

		return $return;
	}
}