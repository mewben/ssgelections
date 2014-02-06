<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('semesters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sy');
			$table->string('sem', 1);
			$table->integer('campus_id')->unsigned();
			$table->string('status')->nullable();

			$table->softDeletes();

			$table->unique(array('sy', 'sem', 'campus_id'));
			$table->index('sy');
			$table->index('campus_id');

			$table->foreign('campus_id')->references('id')->on('campuses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('semesters', function(Blueprint $table) {
			$table->dropForeign('semesters_campus_id_foreign');
		});

		Schema::drop('semesters');
	}

}
