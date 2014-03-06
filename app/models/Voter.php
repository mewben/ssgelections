<?php

class Voter extends BaseModel {

	protected $table='voters';
	protected $fillable = ['voter_id', 'lname', 'fname', 'mname', 'college_id', 'year', 'sem_id', 'voted', 'passcode'];

	public static $rules = [
		'voter_id' => 'required',
		'lname' => 'required',
		'fname' => 'required',
		'college_id' => 'required',
		'year' => 'required',
		'sem_id' => 'required'
	];

	public function college()
	{
		return $this->belongsTo('College');
	}

	public function semester()
	{
		return $this->belongsTo('Semester', 'sem_id');
	}

	public static function getAll()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester code selected.", 409);

		return static::with('college')->where('sem_id', '=', Session::get('user.sem.id'))->orderBy('college_id')->orderBy('lname')->get()->toArray();
	}

	public static function import()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester code selected.", 409);

		// Extract data from csv
		$data = Excel::load(Input::file('file')->getRealPath(), false, 'ISO-8859-1')->toArray();
		
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

			$newdata = [];
			$newdata['voter_id'] = $value[1];
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
			DB::table('voters')->where('id', '=', $value['id'])->update(array('passcode' => mt_rand(123456, 987654), 'voted' => null));
		}

		return true;
	}

	public static function export($data)
	{
		$obj = Excel::create('VotersList')->sheet('Sheet 1');

		$obj->excel->getActiveSheet()->setCellValue('A1', Session::get('user.campus.name'));
		$obj->excel->getActiveSheet()->setCellValue('A2', Session::get('user.campus.address'));
		$obj->excel->getActiveSheet()->setCellValue('A3', 'S.Y.' . Session::get('user.sem.sy') . '-' . (Session::get('user.sem.sy') + 1) . ' SEM:' . Session::get('user.sem.sem'));
		$obj->excel->getActiveSheet()->setCellValue('A4', 'Total Items: '. count($data));

		$baseRow = 6;
		foreach ($data as $key => $value) {
			$row = $baseRow + $key;
			$fullName = $value['lname'] . ', ' . $value['fname'] . ', ' . $value['mname'];

			//$obj->excel->getActiveSheet()->insertNewRowBefore($row+1,1);
			$obj->excel->getActiveSheet()->setCellValue('A' . $row, $key+1)
										 ->setCellValue('B' . $row, $value['voter_id'])
										 ->setCellValue('C' . $row, $fullName)
										 ->setCellValue('D' . $row, $value['college']['code'])
										 ->setCellValue('E' . $row, $value['year'])
										 ->setCellValue('G' . $row, 'LOGIN:')
										 ->setCellValue('H' . $row, $value['voter_id'])
										 ->setCellValue('I' . $row, 'PASSCODE:')
										 ->setCellValue('J' . $row, $value['passcode']);

		}

		$row++;
		$obj->excel->getActiveSheet()->setCellValue('A' . $row, '*** NOTHING FOLLOWS ***');

		return $obj->setTitle('Offial List of Voters')->export('xls');
	}

	public static function count()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester code selected.", 409);

		$data['total'] = static::where('sem_id', '=', Session::get('user.sem.id'))->count();
		$data['voted'] = static::where('sem_id', '=', Session::get('user.sem.id'))->whereNotNull('voted')->count();

		return $data;
	}
}