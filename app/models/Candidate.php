<?php

class Candidate extends BaseModel {

	protected $table = 'candidates';
	protected $softDelete = true;
	protected $fillable = ['name', 'position_id', 'party_id', 'sem_id', 'status'];
	public $timestamps = false;

	public static $rules = [
		'name' => 'required|max:255',
		'position_id' => 'required',
		'party_id' => 'required'
	];

	public function position()
	{
		return $this->belongsTo('Position');
	}

	public function party()
	{
		return $this->belongsTo('Party');
	}

	public function results()
	{
		return $this->hasMany('Ballot');
	}

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$with = ['position', 'party'];
		$where = [['sem_id', '=', Session::get('user.sem.id')]];
		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester code selected above. Please select semester.", 409);
		$data['sem_id'] = Session::get('user.sem.id');

		return parent::store($data, $id);
	}

	/**
	 * getList for queries {list: 1}
	 */
	public function getList()
	{
		return parent::fetchList(array('code', 'name', 'id'), 'code', Session::get('user.campus.id'));
	}
}