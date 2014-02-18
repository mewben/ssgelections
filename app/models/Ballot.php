<?php 

Class Ballot extends BaseModel {
	protected $table = 'ballots';
	protected $softDelete = true;
	protected $fillable = ['voter_id', 'sem_id', 'candidate_id'];
	public $timestamps = false;

	public function position()
	{
		return $this->belongsTo('Position');
	}
	public function partylist()
	{
		return $this->belongsTo('Partylist')
	}
	public function fetch($filters = NULL, $with = NULL, $where = NULL)
	{
		$with = ['position', 'partylist'];
		$where = [['sem_id', '=', Session::get('user.sem.id')]];
		return parent::fetch($filters, $with, $where);
	}
	public function postLogin()
	{
		
	}
}

?>