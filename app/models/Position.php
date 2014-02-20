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

	public function candidates()
	{
		return $this->hasMany('Candidate')->with('party')->with('results')->where('sem_id', '=', Session::get('user.sem.id'))->orderBy('name');
	}

	public function options()
	{
		return $this->hasMany('Candidate')->with('party')->whereSemId(Session::get('voter.sem_id'))->orderBy('name');
	}

	public function college()
	{
		return $this->belongsTo('College');
	}

	public function setCodeAttribute($value)
	{
		$this->attributes['code'] = strtoupper($value);
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