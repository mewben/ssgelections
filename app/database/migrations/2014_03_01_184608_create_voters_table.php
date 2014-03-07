<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voters', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('voter_id')->unsigned();
			$table->string('lname');
			$table->string('fname');
			$table->string('mname')->nullable();
			$table->integer('college_id')->unsigned();
			$table->smallInteger('year');
			$table->integer('sem_id')->unsigned();
			$table->boolean('voted')->nullable();
			$table->string('passcode')->nullable();

			$table->timestamps();

			$table->unique(array('voter_id', 'sem_id'));
			$table->foreign('college_id')->references('id')->on('colleges');
			$table->foreign('sem_id')->references('id')->on('semesters');
		});

		//
		Schema::create('ballots', function(Blueprint $table)
		{
			$table->integer('voter_id')->unsigned();
			$table->integer('candidate_id')->unsigned();
			$table->integer('sem_id')->unsigned();
			$table->timestamps();

			$table->primary(array('voter_id', 'sem_id', 'candidate_id'));
			$table->foreign('voter_id')->references('id')->on('voters');
			$table->foreign('candidate_id')->references('id')->on('candidates');
			$table->foreign('sem_id')->references('id')->on('semesters');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('voters', function(Blueprint $table) {
			$table->dropForeign('voters_college_id_foreign');
			$table->dropForeign('voters_sem_id_foreign');
		});
		Schema::drop('voters');
	}

}
