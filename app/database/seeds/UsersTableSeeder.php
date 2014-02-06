<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		Role::insert([
			[
				'name' => 'superadmin',
				'desc' => 'Super Administrator'
			],
			[
				'name' => 'admin',
				'desc' => 'Administrator'
			],
			[
				'name' => 'bei',
				'desc' => 'Can retrieve data'
			],
		]);
		$u = User::create([
			'username' => 'superadmin',
			'email' => 'melvinsoldia@bisu.edu.ph',
			'password' => 'passwD',
			'confirmed' => true
		]);

		$u->roles()->attach(1);
	}
}