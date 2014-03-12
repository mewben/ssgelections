<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code');
			$table->string('name');
			$table->integer('college_id')->unsigned()->nullable();
			$table->integer('year')->nullable();
			$table->integer('num_winner')->default(1);
			$table->integer('order')->nullable();
			$table->string('status')->nullable();
			$table->integer('campus_id')->unsigned();

			$table->softDeletes();

			$table->unique(array('code', 'college_id'));
			$table->index('code');
			$table->foreign('college_id')->references('id')->on('colleges');
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
		Schema::table('positions', function(Blueprint $table) {
            $table->dropForeign('positions_college_id_foreign');
            $table->dropForeign('positions_campus_id_foreign');
        });

		Schema::drop('positions');
	}

}
