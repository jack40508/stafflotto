<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prizes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('code');
			$table->string('type');
			$table->boolean('level');
			$table->integer('amount');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prizes');
	}

}
