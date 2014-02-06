<?php

class CampusesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('campuses')->insert(['name' => 'Main Campus']);
	}
}