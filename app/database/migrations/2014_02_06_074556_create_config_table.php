<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('config', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('value')->nullable();
			$table->integer('campus_id')->unsigned()->default(0);
			$table->timestamps();

			$table->unique(array('name', 'campus_id'));
			$table->index('name');
			$table->index('value');
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
		Schema::table('config', function(Blueprint $table) {
            $table->dropForeign('config_campus_id_foreign');
        });

		Schema::drop('config');
	}

}
