<?php

class Voter extends BaseModel {

	protected $table='voters';
	protected $fillable = ['id', 'lname', 'fname', 'mname', 'college_id', 'year', 'sem_id', 'voted', 'passcode'];

	public static $rules = [
		'id' => 'required',
		'lname' => 'required',
		'fname' => 'required',
		'college_id' => 'required',
		'year' => 'required',
		'sem_id' => 'required'
	];

	public static function import()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester code selected.", 409);

		// Extract data from csv
		$data = Excel::load(Input::file('file')->getRealPath())->toArray();

		// prepare data
		$newdata = [];
		$colleges = [];
		$sem_id = Session::get('user.sem.id');
		$now = date('Y-m-d H:i:s');

		if (Input::get('remove'))	static::where('sem_id', '=', Session::get('user.sem.id'))->delete();

		foreach ($data as $key => $value) {
			$coll = strtoupper($value[5]);

			if (!array_key_exists($coll, $colleges)) {	// college not yet in $colleges
				// get the id of college
				if (!$c = College::where('code', '=', $coll)->get(array('id'))->toArray()) { // no college found
					$college = (new College)->store(['code' => $coll, 'name' => $coll]);
					$colleges[$college['code']] = $college['id'];
				} else { // just add the id to the $colleges
					$colleges[$coll] = $c[0]['id'];
				}
			}

			/*$newdata[$key]['id'] = $value[1];
			$newdata[$key]['lname'] = $value[2];
			$newdata[$key]['fname'] = $value[3];
			$newdata[$key]['mname'] = $value[4];
			$newdata[$key]['college_id'] = $colleges[$coll];
			$newdata[$key]['year'] = $value[6];
			$newdata[$key]['sem_id'] = $sem_id;
			$newdata[$key]['created_at'] = $now;
			$newdata[$key]['updated_at'] = $now;*/
			$newdata = [];
			$newdata['id'] = $value[1];
			$newdata['lname'] = $value[2];
			$newdata['fname'] = $value[3];
			$newdata['mname'] = $value[4];
			$newdata['college_id'] = $colleges[$coll];
			$newdata['year'] = $value[6];
			$newdata['sem_id'] = $sem_id;
			$newdata['created_at'] = $now;
			$newdata['updated_at'] = $now;

			DB::table('voters')->insert($newdata);
		}
		unset($data);

		return true;
	}

	public static function generate()
	{
		// get all voters in sem_id
		$data = static::where('sem_id', '=', Session::get('user.sem.id'))->get(array('id'))->toArray();
		foreach ($data as $key => $value) {
			$data[$key]['passcode'] = mt_rand(123456, 987654);
			DB::table('voters')->where('id', '=', $value['id'])->update(array('passcode' => mt_rand(123456, 987654)));
		}

		return true;
	}
}