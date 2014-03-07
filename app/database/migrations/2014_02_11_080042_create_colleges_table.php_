<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('colleges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code');
			$table->text('name');
			$table->string('status')->nullable();
			$table->integer('campus_id')->unsigned();

			$table->softDeletes();

			$table->unique(array('code', 'campus_id'));
			$table->index('code');
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
		Schema::table('colleges', function(Blueprint $table) {
            $table->dropForeign('colleges_campus_id_foreign');
        });
		Schema::drop('colleges');
	}

}
