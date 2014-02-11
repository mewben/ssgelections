<?php

class Partylist extends BaseModel {

	protected $table = 'partylists';
	protected $softDelete = true;
	protected $fillable = ['code', 'name', 'status', 'campus_id'];
	public $timestamps = false;

	public static $rules = [
		'code' => 'required|max:255',
		'name' => 'required'
	];


	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
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