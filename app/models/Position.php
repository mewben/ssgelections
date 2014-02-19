<?php

class Position extends BaseModel {

	protected $table = 'positions';
	protected $softDelete = true;
	protected $fillable = ['code', 'name', 'college_id', 'year', 'num_winner', 'order', 'status', 'campus_id'];
	public $timestamps = false;

	public static $rules = [
		'code' => 'required|max:255',
		'name' => 'required'
	];

	public function setCodeAttribute($value)
	{
		$this->attributes['code'] = strtoupper($value);
	}
	public function candidate()
	{
		return $this->hasMany('Candidate');
	}
	public function college()
	{
		return $this->belongsTo('College');
	}

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$with = ['college'];
		$where = [['campus_id', '=', Session::get('user.campus.id')]];
		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		if(isset($data['order']) AND $data['order'] == '')	$data['order'] = NULL;
		$data['campus_id'] = Session::get('user.campus.id');
		return parent::store($data, $id);
	}

	/**
	 * getList for queries {list: 1}
	 */
	public function getList()
	{
		return parent::fetchList(array('code', 'name', 'id'), 'order', Session::get('user.campus.id'));
	}
}