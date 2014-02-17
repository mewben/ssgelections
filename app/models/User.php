<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\ConfideUser;

class User extends ConfideUser implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	protected $softDelete = true;
	public static $rules = [
		'username' => 'required',
		'email' => 'required',
		'password' => 'required'
	];

	public function roles()
	{
		return $this->belongsToMany('Role', 'assigned_roles');
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Fetch all
	 */
	public function fetch($filters = NULL)
	{
		$count = isset($filters['count']) AND is_numeric($filters['count']) ? $filters['count'] : 20;
		if (isset($filters['filter']) AND $filters['filter'] == 'active')		unset($filters['filter']);

		$model = new static;

		$model = $model->with('roles');

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

		$model = $model->where('campus_id', '=', Session::get('user.campus.id'));

		return $model->paginate($count)->toArray();
	}

	/**
	 * Store
	 */
	public function store($data, $id = NULL)
	{
		if (isset($data['restore']) && isset($id)) { // restore item
			$user = static::onlyTrashed()->findOrFail($id);
			$user->restore();
			$user->updateUniques();
			return $user->toArray();
		}

		if (!isset($id))	$user = new static;
		else 				$user = static::findOrFail($id);

		$user->username = isset($data['username']) ? e($data['username']) : '';
		$user->email = isset($data['email']) ? e($data['email']) : '';

		if (isset($data['password'])) $user->password = $data['password'];
		$user->campus_id = Session::get('user.campus.id');

		$user->status = $data['status'];
		$user->confirmed = true;

		if (!isset($id))	$user->save();
		else 				$user->updateUniques();

		if($user->id) 	{
			if (isset($data['roles']))		$user->roles()->sync($data['roles']);
			return $user->toArray();
		}
		else 			throw new Exception($user->errors(), 400);
	}

	/**
	 * Remove
	 */
	public function remove($id, $force = NULL)
	{
		if (isset($force)) {
			$model = static::withTrashed()->findOrFail($id);
			$model->roles()->sync(array());
			$model->forceDelete();
		} else {
			$model = static::findOrFail($id);
			$model->delete();
		}

		return true;
	}


	/**
	 * Checks the user session for roles
	 */
	public static function hasRole($role)
	{
		if (!is_array($role))
			$role = (array) $role;

		$roles = array_fetch(Session::get('user.roles'), 'name');
		foreach ($role as $r) {
			if (in_array($r, $roles))	return true;
		}

		return false;
	}
}