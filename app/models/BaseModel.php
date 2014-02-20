<?php

class BaseModel extends Eloquent {

	public $errors;
	public static $rules = [];

	/**
	 * Fetch all
	 */
	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$count = (isset($filters['count']) AND is_numeric($filters['count'])) ? $filters['count'] : 100;
		if (isset($filters['filter']) AND $filters['filter'] == 'active')		unset($filters['filter']);

		$model = new static;

		// with
		if (isset($with))		$model = $model->with($with);

		// where
		if (isset($where) AND is_array($where)) {
			foreach ($where as $key => $value) {
				$model = $model->where($value[0], $value[1], $value[2]);
			}
		}

		// filters
		if (isset($filters['filter']) AND $filters['filter'] != '') {
			if ($filters['filter'] == 'trashed')	$model = $model->onlyTrashed();
			else 									$model = $model->where('status', '=', strtolower($filters['filter']));
		} else {
			$model = $model->where(function($query) {
				$query->where('status', '!=', 'blocked')
					  ->orWhereNull('status');
			});
		}

		return $model->paginate($count)->toArray();
	}

	/**
	 * Store
	 */
	public function store($data, $id = NULL)
	{
		if (isset($data['restore']) AND isset($id)) {	// restore item
			$model = static::onlyTrashed()->findOrFail($id);
			$model->restore();
			return $model->toArray();
		}

		// prepare data to be inserted
		$item = $this->sanitize($data);

		if (!isset($id))	$model = new static;
		else 				$model = static::findOrFail($id);

		$model->fill($item);

		if (!$model->validate())	throw new Exception($model->errors, 400);

		$model->save();

		return $model->toArray();
	}

	/**
	 * Remove
	 */
	public function remove($id, $force = NULL)
	{
		if (isset($force)) {
			$model = static::withTrashed()->findOrFail($id);
			$model->forceDelete();
		} else {
			$model = static::findOrFail($id);
			$model->delete();
		}

		return true;
	}

	/**
	 * fetchList
	 * fields = array
	 * orderBy
	 * campus_id
	 */
	public function fetchList($fields, $orderBy = NULL, $campus_id)
	{
		$model = new static;

		$model = $model->whereNull('status');

		if (isset($campus_id))		$model = $model->where('campus_id', '=', $campus_id);

		$model = $model->orderBy($orderBy);

		$result['data'] = $model->get($fields)->toArray();

		return $result;
	}

	/**
	 * Sanitize array
	 */
	public function sanitize($data)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_numeric($value))					$data[$key] = $value + 0;
				elseif (gettype($value) === 'string') {
					$v = e(trim($value));
					$v = str_replace('&Ntilde;', 'Ñ', $v);
					$v = str_replace('&ntilde;', 'ñ', $v);
					$v = str_replace('&amp;', '&', $v);

					$data[$key] = $v;
				}
				else 									$data[$key] = $value;
			}
		} else {
			$data = e(trim($data));
		}

		return $data;
	}

	/**
	 * Validate service
	 */
	public function validate()
	{
		$v = Validator::make($this->attributes, static::$rules);

		if ($v->passes())	return true;

		$this->errors = $v->messages();
		return false;
	}
}