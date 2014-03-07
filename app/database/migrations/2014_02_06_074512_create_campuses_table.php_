<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campuses', function(Blueprint $table)
		{
			$table->increments('id', 2);
			$table->string('name');
			$table->string('address')->nullable();
			$table->string('status')->nullable();
			$table->string('color', 7)->nullable();

			$table->softDeletes();

			$table->unique('name');
			$table->index('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('campuses');
	}

}
