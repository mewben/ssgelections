<?php

class Ballot extends BaseModel {
	protected $table = 'ballots';
	protected $fillable = ['voter_id', 'candidate_id', 'sem_id'];

	public function position()
	{
		return $this->belongsTo('Position');
	}

	public function partylist()
	{
		return $this->belongsTo('Partylist');
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

		return $result;
	}

	public static function initialize()
	{
		if (!Session::has('user.sem.id'))	throw new Exception("No semester Code selected.", 409);
		// rezero count
		$model = static::where('sem_id', '=', Session::get('user.sem.id'))->delete();

		// set 2 pass codes for close voting
		Configuration::set('close_passcode_1', mt_rand(12345678, 98765432), Session::get('user.campus.id'));
		Configuration::set('close_passcode_2', mt_rand(12345678, 98765432), Session::get('user.campus.id'));
		return 1;
	}
}