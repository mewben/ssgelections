<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBallotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
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
		//
		Schema::table('ballots', function(Blueprint $table){
			$table->dropForeign('ballots_voter_id_foreign');
			$table->dropForeign('ballots_sem_id_foreign');
			$table->dropForeign('ballots_candidate_id_foreign');
		});

		Schema::drop('ballots');
	}

}
