<?php

class SemestersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('semesters')->insert(['sy' => '1990', 'sem' => '1', 'campus_id' => '1']);
	}
}