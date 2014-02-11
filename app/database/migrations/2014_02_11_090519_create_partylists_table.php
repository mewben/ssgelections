<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartylistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partylists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code');
			$table->string('name');
			$table->string('status')->nullable();
			$table->integer('campus_id')->unsigned();

			$table->softDeletes();

			$table->unique(array('code', 'name', 'campus_id'));
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
		Schema::table('partylists', function(Blueprint $table) {
            $table->dropForeign('partylists_campus_id_foreign');
        });

		Schema::drop('partylists');
	}

}
