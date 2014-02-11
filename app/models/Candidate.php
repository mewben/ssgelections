<?php

class Candidate extends BaseModel {

	protected $table = 'candidates';
	protected $softDelete = true;
	protected $fillable = ['name', 'position_id', 'partylist_id', 'campus_id', 'status'];
	public $timestamps = false;

	public static $rules = [
		'name' => 'required|max:255',
		'position_id' => 'required',
		'partylist_id' => 'required'
	];

	public function position()
	{
		return $this->belongsTo('Position');
	}

	public function partylist()
	{
		return $this->belongsTo('Partylist');
	}

	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$with = ['position', 'partylist'];
		$where = [['campus_id', '=', Session::get('user.campus.id')]];
		return parent::fetch($filters, $with, $where);
	}

	public function store($data, $id = NULL)
	{
		$data['campus_id'] = Session::get('user.campus.id');
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