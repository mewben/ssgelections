<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('candidates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('position_id')->unsigned();
			$table->integer('party_id')->unsigned();
			$table->integer('sem_id')->unsigned();
			$table->string('status')->nullable();

			$table->softDeletes();

			$table->unique(array('name', 'sem_id'));
			$table->index('name');
			$table->foreign('position_id')->references('id')->on('positions');
			$table->foreign('party_id')->references('id')->on('party');
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
		Schema::table('candidates', function(Blueprint $table) {
			$table->dropForeign('candidates_position_id_foreign');
			$table->dropForeign('candidates_party_id_foreign');
            $table->dropForeign('candidates_sem_id_foreign');
        });
		Schema::drop('candidates');
	}

}
