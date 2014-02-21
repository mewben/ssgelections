<?php

class Ballot extends BaseModel {
	protected $table = 'ballots';
	protected $fillable = ['voter_id', 'candidate_id', 'sem_id'];

	public function position()
	{
		return $this->belongsTo('Position');
	}

	public function party()
	{
		return $this->belongsTo('Party');
	}

	public static function getResults()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester Code selected.", 409);

		// get positions with candidates with results
		$model = new Position;

		$model = $model->with('candidates');
		$model = $model->whereHas('candidates', function($q) {
			$q->where('sem_id', '=', Session::get('user.sem.id'));
		});

		/*$model = $model->where(function ($query) {
			$query->where(function($q) {
				$q->whereNull('college_id')
					->WhereNull('year');
			});
			$query->orWhere(function($q) {
				$q->where('college_id', '=', )
					->WhereNull('year');
			});
		});*/

		$model = $model->where(function($query) {

		});
		$model = $model->where('campus_id', '=', Session::get('user.campus.id'));

		$model = $model->orderBy('order');
		$result = $model->get()->toArray();

		foreach ($result as $kp => $positions) {
			foreach ($positions['candidates'] as $kc => $candidates) {
				$result[$kp]['candidates'][$kc]['results'] = count($candidates['results']);
			}
		}

		return $result;
	}

	public static function getOptions()
	{
		//fetch positions with candidates
		$model = new Position;

		$model = $model->with('options');
		$model = $model->where(function ($query) {
			$query->where(function($q) {
				$q->whereNull('college_id')
					->WhereNull('year');
			});
			$query->orWhere(function($q) {
				$q->where('college_id', '=', Session::get('voter.college_id'))
					->WhereNull('year');
			});
			$query->orWhere(function($q){
				$q->where('college_id', '=', Session::get('voter.college_id'))
					->where('year', '=', Session::get('voter.year'));
			});
		});

		$model = $model->where(function($query) {

		});

		$model = $model->orderBy('order');
		$options = $model->get()->toArray();

		return $options;
	}

	public static function initialize()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester Code selected.", 409);

		// delete all votes
		$model = static::where('sem_id', '=', Session::get('user.sem.id'))->delete();

		// set 2 pass codes for close voting
		Configuration::set('close_passcode_1', mt_rand(12345678, 98765432), Session::get('user.campus.id'));
		Configuration::set('close_passcode_2', mt_rand(12345678, 98765432), Session::get('user.campus.id'));
		return 1;
	}

	public static function closeVoting($passcodes, $campus_id, $sem_id)
	{
		// check 2 passcodes if correct
		if (!Configuration::where('name', '=', 'close_passcode_1')->where('value', '=', Input::get('passcode1'))->where('campus_id', '=', $campus_id)->first() OR 
			!Configuration::where('name', '=', 'close_passcode_2')->where('value', '=', Input::get('passcode2'))->where('campus_id', '=', $campus_id)->first())
			throw new Exception('Pass Codes Incorrect!', 400);

		Configuration::where('name', '=', 'open_voting')->where('campus_id', '=', $campus_id)->delete();

		Session::flush();
		Session::put('user.campus', Campus::findOrFail($campus_id)->toArray());
		Session::put('user.sem', Semester::findOrFail($sem_id)->toArray());
		return 1;
	}

	public static function cast($data)
	{
		$voter_id = Session::get('voter.id');
		$sem_id = Session::get('voter.semester.id');
		$now = date('Y-m-d H:i:s');

		// check if already voted
		$voter = Voter::findOrFail($voter_id);
		if ($voter->voted != NULL)	throw new Exception('Already voted!', 400);

		// save the candidate ids with voter_id
		foreach($data as $cid) {
			DB::table('ballots')->insert(array(
				'voter_id' => $voter_id,
				'candidate_id' => $cid,
				'sem_id' => $sem_id,
				'created_at' => $now,
				'updated_at' => $now
				));
		}

		$voter->voted = true;
		$voter->save();

		// flush session
		Session::flush();

		return 1;
	}
}